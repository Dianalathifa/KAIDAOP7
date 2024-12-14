<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Katalog;
use App\Models\MasukCatalog;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    public function exportExcel(Request $request)
{
    $tahun = $request->input('tahun');
    
    // Validasi input tahun
    if (!$tahun || !is_numeric($tahun) || strlen($tahun) != 4) {
        return redirect()->back()->with('error', 'Pilih tahun yang valid.');
    }

    try {
        // Menggunakan export untuk MasterBarang
        return Excel::download(new MasterBarangExport($tahun), 'master_barang_' . $tahun . '.xlsx');
    } catch (\Exception $e) {
        // Tangani error jika ada
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file Excel: ' . $e->getMessage());
    }
}

    // Menampilkan daftar barang dengan paginasi
    public function index(Request $request)
    {
        $katakunci = $request->get('katakunci');
        $katalogs = Katalog::all();
        $masterBarangs = MasterBarang::when($katakunci, function ($query, $katakunci) {
            return $query->where('nama_barang', 'LIKE', "%$katakunci%")
                 ->orWhere('kode_barang', 'LIKE', "%$katakunci%");
        })->paginate(10);

        $tahunOptions = MasterBarang::selectRaw('YEAR(created_at) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

        foreach ($masterBarangs as $barang) {
            $barang->barang_masuk = MasukCatalog::where('kode_barang', $barang->kode_barang)->sum('jumlah_masuk');
            $barang->total_stok = $barang->barang_masuk - $barang->barang_keluar;
            $barang->save();
        }

        return view('masterbarang.index', compact('masterBarangs', 'katalogs', 'tahunOptions'));
    }

    // Mengambil detail item berdasarkan kode_barang
    public function getItemDetails($kode_barang)
    {
        $item = MasterBarang::where('kode_barang', $kode_barang)->first();
        if ($item) {
            return response()->json([
                'nama_barang' => $item->nama_barang,
                'barang_masuk' => MasukCatalog::where('kode_barang', $kode_barang)->sum('jumlah_masuk')
            ]);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }

    public function create()
    {
        $katalogs = Katalog::all();
        return view('masterbarang.create', compact('katalogs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|unique:master_catalogs,kode_barang',
            'barang_keluar' => 'nullable|integer|min:0',
        ]);

        $katalog = Katalog::where('kode_barang', $request->kode_barang)->first();

        if (!$katalog) {
            return redirect()->back()->withErrors(['kode_barang' => 'Kode Barang tidak ditemukan dalam katalog'])->withInput();
        }

        $jumlahMasuk = MasukCatalog::where('kode_barang', $request->kode_barang)->sum('jumlah_masuk');

        MasterBarang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $katalog->nama,
            'barang_masuk' => $jumlahMasuk,
            'barang_keluar' => $request->barang_keluar ?? 0,
            'total_stok' => $jumlahMasuk - ($request->barang_keluar ?? 0),
        ]);

        return redirect()->route('masterbarang.index')->with('success', 'Master Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $masterBarang = MasterBarang::findOrFail($id);
        $katalogs = Katalog::all();
        return view('masterbarang.edit', compact('masterBarang', 'katalogs'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|string',
            'barang_keluar' => 'nullable|integer|min:0',
        ]);

        $masterBarang = MasterBarang::findOrFail($id);

        $katalog = Katalog::where('kode_barang', $request->kode_barang)->first();

        if (!$katalog) {
            return redirect()->back()->withErrors(['kode_barang' => 'Kode Barang tidak ditemukan dalam katalog'])->withInput();
        }

        $jumlahMasuk = MasukCatalog::where('kode_barang', $request->kode_barang)->sum('jumlah_masuk');

        $masterBarang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $katalog->nama,
            'barang_masuk' => $jumlahMasuk,
            'barang_keluar' => $request->barang_keluar ?? $masterBarang->barang_keluar,
            'total_stok' => $jumlahMasuk - ($request->barang_keluar ?? $masterBarang->barang_keluar),
        ]);

        return redirect()->route('masterbarang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $masterBarang = MasterBarang::findOrFail($id);
        $this->updateMasterCatalogStock($masterBarang->kode_barang, $masterBarang->barang_keluar, 'decrement');
        $masterBarang->delete();

        return redirect()->route('masterbarang.index')->with('success', 'Master Barang berhasil dihapus');
    }

    private function updateMasterCatalogStock($kode_barang, $jumlah, $operation = 'decrement')
    {
        $masterCatalog = MasterBarang::where('kode_barang', $kode_barang)->first();

        if ($masterCatalog) {
            if ($operation === 'increment') {
                $masterCatalog->increment('barang_masuk', $jumlah);
                $masterCatalog->increment('total_stok', $jumlah);
            } elseif ($operation === 'decrement') {
                $newTotalStok = max(0, $masterCatalog->total_stok - $jumlah);
                $newBarangKeluar = $masterCatalog->barang_keluar + $jumlah;

                $masterCatalog->update([
                    'barang_keluar' => $newBarangKeluar,
                    'total_stok' => $newTotalStok
                ]);
            }
        }
    }
}
