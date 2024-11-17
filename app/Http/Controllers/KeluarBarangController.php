<?php

namespace App\Http\Controllers;

use App\Models\KeluarBarangCatalog; // Model untuk barang keluar
use App\Models\MasterBarang; // Model untuk master barang
use App\Models\Katalog; // Model untuk katalog
use App\Models\UnitKerja; // Model untuk unit kerja
use Illuminate\Http\Request;

class KeluarBarangController extends Controller
{
    private const KODE_PREFIX = 'BK'; // Kode prefix untuk kode_keluar

    public function index()
    {
        $katalogs = Katalog::all();
        $units = UnitKerja::all();
        $keluarBarangs = KeluarBarangCatalog::with(['katalog', 'unitKerja'])->paginate(10);
        
        $totalKeluarBarang = KeluarBarangCatalog::sum('jumlah_keluar');
        
        return view('keluarbarang.index', compact('units', 'katalogs', 'keluarBarangs', 'totalKeluarBarang'));
    }

    public function create()
    {
        $katalogs = Katalog::all();
        $units = UnitKerja::all();

        return view('keluarbarang.create', compact('katalogs', 'units'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|string|exists:master_catalogs,kode_barang',
        'jumlah_keluar' => 'required|integer|min:1',
        'unit_id' => 'required|exists:pengaturan_unit_kerja,id',
    ]);

    $katalog = MasterBarang::where('kode_barang', $request->kode_barang)->firstOrFail();

    $newKodeKeluar = $this->generateKodeKeluar();

    KeluarBarangCatalog::create([
        'kode_keluar' => $newKodeKeluar,
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $katalog->nama_barang,
        'jumlah_keluar' => $request->jumlah_keluar,
        'unit_id' => $request->unit_id,
        'tanggal_keluar' => now(),
    ]);

    // Update data pada master_catalogs
    $this->updateMasterCatalogStock($request->kode_barang, $request->jumlah_keluar, 'decrement');

    return redirect()->route('keluarbarang.index')->with('success', 'Data keluar barang berhasil ditambahkan');
}


    private function generateKodeKeluar()
    {
        $lastRecord = KeluarBarangCatalog::orderBy('created_at', 'desc')->first();
        if (!$lastRecord) return self::KODE_PREFIX . '00001';

        $lastKode = $lastRecord->kode_keluar;
        $number = (int) substr($lastKode, 2) + 1;
        return self::KODE_PREFIX . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    private function updateMasterCatalogStock($kode_barang, $jumlah, $operation = 'increment')
    {
        $masterCatalog = MasterBarang::where('kode_barang', $kode_barang)->first();
        
        if ($masterCatalog) {
            if ($operation === 'increment') {
                $masterCatalog->increment('barang_masuk', $jumlah);
                $masterCatalog->increment('total_stok', $jumlah);
            } elseif ($operation === 'decrement') {
                $masterCatalog->increment('barang_keluar', $jumlah); // Pastikan increment sesuai dengan logika bisnis
                $newTotalStok = max(0, $masterCatalog->total_stok - $jumlah);
                $masterCatalog->update([
                    'total_stok' => $newTotalStok
                ]);
            } elseif ($operation === 'restore') {
                $masterCatalog->decrement('barang_keluar', $jumlah);
                $masterCatalog->increment('barang_masuk', $jumlah);
                $masterCatalog->increment('total_stok', $jumlah);
            }
        }
    }
    

    public function getDetailBarang($kode_barang)
    {
        $katalog = Katalog::where('kode_barang', $kode_barang)->first();
        
        if ($katalog) {
            return response()->json([
                'success' => true,
                'data' => $katalog
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function edit($keluar_barang_id)
    {
        $keluarBarang = KeluarBarangCatalog::findOrFail($keluar_barang_id);
        return response()->json($keluarBarang);
    }

    public function update(Request $request, $keluar_barang_id)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'jumlah_keluar' => 'required|integer|min:1',
            'unit_id' => 'required|exists:pengaturan_unit_kerja,id',
        ]);

        $keluarBarang = KeluarBarangCatalog::findOrFail($keluar_barang_id);
        $keluarBarang->kode_barang = $request->kode_barang;
        $keluarBarang->jumlah_keluar = $request->jumlah_keluar;
        $keluarBarang->unit_id = $request->unit_id;
        $keluarBarang->save();

        session()->flash('success', 'Data berhasil diupdate!');
        return redirect()->route('keluarbarang.index');
    }

    public function destroy($keluar_barang_id)
    {
        $keluarBarang = KeluarBarangCatalog::findOrFail($keluar_barang_id);

        // Update stok pada master_catalogs saat data keluar barang dihapus
        $masterCatalog = MasterBarang::where('kode_barang', $keluarBarang->kode_barang)->first();
        if ($masterCatalog) {
            $this->updateMasterCatalogStock($keluarBarang->kode_barang, $keluarBarang->jumlah_keluar, 'restore');
        }

        $keluarBarang->delete();

        return redirect()->route('keluarbarang.index')->with('success', 'Data keluar barang berhasil dihapus');
    }

}
