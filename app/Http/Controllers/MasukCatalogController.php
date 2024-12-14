<?php

namespace App\Http\Controllers;

use App\Models\MasukCatalog;
use App\Models\MasterBarang;
use App\Models\Katalog;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class MasukCatalogController extends Controller
{
    private const KODE_PREFIX = 'BM'; // Kode prefix untuk kode_masuk

    public function index(Request $request)
    {
        $katakunci = $request->get('katakunci');
        $katalogs = Katalog::all();
        $units = UnitKerja::all();
        $masukCatalogs = MasukCatalog::with(['katalog', 'unitKerja'])
        ->when($katakunci, function ($query, $katakunci) {
            return $query->where('kode_masuk', 'LIKE', "%$katakunci%")
                ->orWhere('kode_barang', 'LIKE', "%$katakunci%")
                ->orWhere('barang', 'LIKE', "%$katakunci%");
        })
        ->paginate(10);
    
        
        $totalMasukCatalog = MasukCatalog::sum('jumlah_masuk');
        
        return view('masukcatalog.index', compact('units', 'katalogs', 'masukCatalogs', 'totalMasukCatalog'));
    }

    public function create()
    {
        $katalogs = Katalog::all();
        $units = UnitKerja::all();

        return view('masukcatalog.create', compact('katalogs', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|exists:katalogs,kode_barang',
            'jumlah_masuk' => 'required|integer|min:1',
            'unit_id' => 'required|exists:pengaturan_unit_kerja,id',
        ]);

        $katalog = Katalog::where('kode_barang', $request->kode_barang)->firstOrFail();
        $newKodeMasuk = $this->generateKodeMasuk();

        MasukCatalog::create([
            'kode_masuk' => $newKodeMasuk,
            'kode_barang' => $request->kode_barang,
            'barang' => $katalog->nama,
            'jumlah_masuk' => $request->jumlah_masuk,
            'unit_id' => $request->unit_id,
        ]);

        $this->updateMasterCatalogStock($request->kode_barang, $request->jumlah_masuk, 'increment');

        return redirect()->route('masukcatalog.index')->with('success', 'Data masuk catalog berhasil ditambahkan');
    }

    private function generateKodeMasuk()
    {
        $lastRecord = MasukCatalog::orderBy('created_at', 'desc')->first();
        if (!$lastRecord) return self::KODE_PREFIX . '00001';

        $lastKode = $lastRecord->kode_masuk;
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
                $newBarangMasuk = max(0, $masterCatalog->barang_masuk - $jumlah);
                $newTotalStok = max(0, $masterCatalog->total_stok - $jumlah);
                
                $masterCatalog->update([
                    'barang_masuk' => $newBarangMasuk,
                    'total_stok' => $newTotalStok
                ]);
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

    public function edit($masuk_barang_id)
    {
        $masukCatalog = MasukCatalog::findOrFail($masuk_barang_id);
        return response()->json($masukCatalog);
    }

    public function update(Request $request, $masuk_barang_id)
{
    $request->validate([
        'kode_barang' => 'required|string',
        'jumlah_masuk' => 'required|integer|min:1',
        'unit_id' => 'required|exists:pengaturan_unit_kerja,id',
    ]);

    $masukCatalog = MasukCatalog::findOrFail($masuk_barang_id);
    $masukCatalog->kode_barang = $request->kode_barang;
    $masukCatalog->jumlah_masuk = $request->jumlah_masuk;
    $masukCatalog->unit_id = $request->unit_id;
    $masukCatalog->save();

    session()->flash('success', 'Data berhasil diupdate!');
    return redirect()->route('masukcatalog.index');
}

    public function destroy($masuk_barang_id)
    {
        $masukCatalog = MasukCatalog::findOrFail($masuk_barang_id);

        // Update stock before deletion
        $masterCatalog = MasterBarang::where('kode_barang', $masukCatalog->kode_barang)->first();
        if ($masterCatalog) {
            $this->updateMasterCatalogStock($masukCatalog->kode_barang, $masukCatalog->jumlah_masuk, 'decrement');
        }

        $masukCatalog->delete();

        return redirect()->route('masukcatalog.index')->with('success', 'Data masuk catalog berhasil dihapus');
    }
} 

