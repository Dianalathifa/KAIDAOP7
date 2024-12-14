<?php

namespace App\Http\Controllers;

use App\Models\NetworkCatalog;
use App\Models\Katalog;
use App\Models\ToolkitCatalog;
use App\Models\WebcamCatalog;
use App\Models\TablemonitorCatalog;
use App\Models\PcLapAioMinipcCatalog;
use App\Models\PrinterCatalog;
use App\Models\CctvCatalog;
use App\Models\Satuan;
use App\Models\Klasifikasi;
use App\Models\MerkCatalog; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Exports\KatalogExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KatalogImport;
use Charts;

class KatalogController extends Controller
{
    public function getDataKatalog()
    {
        $data = Katalog::selectRaw('klasifikasi, COUNT(*) as total')
                    ->groupBy('klasifikasi')
                    ->get();
                    
        return response()->json($data);
    }

    public function showCatalogChart()
    {
        $networkCount = NetworkCatalog::count();
        $toolkitCount = ToolkitCatalog::count();
        $webcamCount = WebcamCatalog::count();
        $tablemonitorCount = TablemonitorCatalog::count();
        $pclapCount = PcLapAioMinipcCatalog::count();
        $printerCount = PrinterCatalog::count();
        $cctvCount = CctvCatalog::count();

        $chart = Charts::create('bar', 'highcharts')
            ->title('Grafik Katalog Barang')
            ->labels(['Network', 'Toolkit', 'Webcam', 'Table Monitor', 'PC/Laptop/Minipc', 'Printer', 'CCTV'])
            ->values([$networkCount, $toolkitCount, $webcamCount, $tablemonitorCount, $pclapCount, $printerCount, $cctvCount])
            ->dimensions(1000, 500)
            ->responsive(true);

        return view('katalog.catalogChart', compact('chart'));
    }

    public function getNextSequenceNumber($klasifikasi)
    {
        $lastBarang = Katalog::where('kode_barang', 'like', $klasifikasi.'%')
                            ->orderBy('kode_barang', 'desc')
                            ->first();

        if ($lastBarang) {
            $lastNumber = intval(substr($lastBarang->kode_barang, -3));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1; // Menggunakan 1 jika tidak ada data sebelumnya
        }

        return response()->json(['sequenceNumber' => str_pad($nextNumber, 3, '0', STR_PAD_LEFT)]);
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun');
        
        if (!$tahun || !is_numeric($tahun) || strlen($tahun) != 4) {
            return redirect()->back()->with('error', 'Pilih tahun yang valid.');
        }

        try {
            return Excel::download(new KatalogExport($tahun), 'katalog_' . $tahun . '.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file Excel: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        // Validasi file input
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048', // Hanya menerima file Excel atau CSV dengan ukuran maksimal 2MB
        ]);

        try {
            // Proses impor data menggunakan KatalogImport
            Excel::import(new KatalogImport, $request->file('file'));

            // Jika berhasil, arahkan kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diimpor!');
        } catch (\Exception $e) {
            // Tangani error saat impor
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengimpor data katalog: ' . $e->getMessage()])->withInput();
        }
    }


    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        $satuan = Satuan::all();
        $merkCatalogs = MerkCatalog::all(); // Ambil data brand
        return view('katalog.tambahbarang', compact('satuan', 'klasifikasi', 'merkCatalogs'));
    }

    public function view(Request $request)
    {
        // Validasi input yang diterima dari request
        $request->validate([
            'kode_barang' => 'nullable|string|max:255',
            'katakunci' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'klasifikasi' => 'nullable|string|max:255',
        ]);

        // Query dasar untuk mengambil data katalog
        $query = Katalog::query();

        // Filter berdasarkan kode barang
        if ($request->filled('kode_barang')) {
            $query->where('kode_barang', 'LIKE', '%' . $request->kode_barang . '%');
        }

        // Filter berdasarkan kata kunci nama barang
        if ($request->filled('katakunci')) {
            $query->where('nama', 'LIKE', '%' . $request->katakunci . '%');
        }

        // Filter berdasarkan tahun dari kolom tanggal_update
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_update', $request->tahun);
        }

        // Filter berdasarkan klasifikasi
        if ($request->filled('klasifikasi')) {
            $query->where('klasifikasi', $request->klasifikasi);
        }

        // Paginate hasil query dengan 10 item per halaman
        $katalog = $query->paginate(10);

        // Ambil daftar tahun yang tersedia untuk opsi filter
        $tahunOptions = Katalog::selectRaw('YEAR(tanggal_update) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Ambil daftar klasifikasi yang tersedia untuk opsi filter
        $klasifikasiOptions = Katalog::select('klasifikasi')
            ->distinct()
            ->orderBy('klasifikasi')
            ->pluck('klasifikasi');

        // Ambil daftar merk (brand) untuk ditampilkan di dropdown
        $merkCatalogs = MerkCatalog::select('merk_nama')
            ->distinct()
            ->orderBy('merk_nama')
            ->pluck('merk_nama');

        // Kirim data ke view
        return view('katalog.viewkatalog', compact('katalog', 'tahunOptions', 'klasifikasiOptions', 'merkCatalogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi' => 'required',
            'kode_barang' => 'required|unique:katalogs',
            'nama' => 'nullable|string|max:255',
            'detail_spesifikasi' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'new_brand' => 'nullable|required_if:brand,lainnya|string|max:255',
            'type' => 'nullable|string|max:255',
            'harga_asli_offline' => 'nullable|numeric',
            'harga_asli_online' => 'nullable|numeric',
            'harga_rab_persen' => 'nullable|numeric',
            'harga_rab_wajar' => 'nullable|numeric',
            'tanggal_update' => 'nullable|date',
            'vendor' => 'nullable|string|max:255',
            'jumlah_kebutuhan' => 'nullable|integer',
            'jumlah_ketersediaan' => 'nullable|integer',
            'satuan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'gambar_perangkat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        $katalog = new Katalog();
        $katalog->klasifikasi = $request->klasifikasi;
        $katalog->kode_barang = $request->kode_barang;
        $katalog->nama = $request->nama;
        $katalog->detail_spesifikasi = $request->detail_spesifikasi;
        $katalog->type = $request->type;
        $katalog->harga_asli_offline = $request->harga_asli_offline;
        $katalog->harga_asli_online = $request->harga_asli_online;
        $katalog->harga_rab_persen = $request->harga_rab_persen;
        $katalog->harga_rab_wajar = $request->harga_rab_wajar;
        $katalog->tanggal_update = $request->tanggal_update;
        $katalog->vendor = $request->vendor;
        $katalog->jumlah_kebutuhan = $request->jumlah_kebutuhan;
        $katalog->jumlah_ketersediaan = $request->jumlah_ketersediaan;
        $katalog->satuan = $request->satuan;
        $katalog->keterangan = $request->keterangan;
        $katalog->link = $request->link;

        // Handle image upload
        if ($request->hasFile('gambar_perangkat')) {
            $image = $request->file('gambar_perangkat');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $katalog->gambar_perangkat = $name;
        }

        // Handle brand
        if ($request->brand === 'lainnya') {
            $brand = $request->new_brand;
            $merkCatalog = MerkCatalog::firstOrCreate(['merk_nama' => $brand]);
            $katalog->brand = $merkCatalog->merk_nama;
        } else {
            $merkCatalog = MerkCatalog::firstOrCreate(['merk_nama' => $request->brand]);
            $katalog->brand = $merkCatalog->merk_nama;
        }

        $katalog->save();

        return redirect()->route('viewkatalog')->with('success', 'Katalog berhasil ditambahkan');
    }

  
    public function edit($id)
{
    // Temukan katalog berdasarkan id
    $katalog = Katalog::findOrFail($id);
    $klasifikasi = Klasifikasi::all();
    $satuan = Satuan::all();
    $merkCatalogs = MerkCatalog::all(); // Ambil data brand

    // Kembalikan view dengan data katalog dan daftar klasifikasi, satuan, serta merk
    return view('katalog.editkatalog', compact('katalog', 'satuan', 'klasifikasi', 'merkCatalogs'));
}

public function update(Request $request, $id)
{
    // Temukan katalog berdasarkan id
    $katalog = Katalog::findOrFail($id);

    // Validasi input
    $validatedData = $request->validate([
        'klasifikasi' => 'required',
        'kode_barang' => 'required|unique:katalogs,kode_barang,' . $katalog->id,
        'nama' => 'nullable|string|max:255',
        'detail_spesifikasi' => 'nullable|string',
        'brand' => 'nullable|string|max:255',
        'new_brand' => 'nullable|required_if:brand,lainnya|string|max:255',
        'type' => 'nullable|string|max:255',
        'harga_asli_offline' => 'nullable|numeric',
        'harga_asli_online' => 'nullable|numeric',
        'harga_rab_persen' => 'nullable|numeric',
        'harga_rab_wajar' => 'nullable|numeric',
        'tanggal_update' => 'nullable|date',
        'vendor' => 'nullable|string|max:255',
        'jumlah_kebutuhan' => 'nullable|integer',
        'jumlah_ketersediaan' => 'nullable|integer',
        'satuan' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string',
        'gambar_perangkat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'link' => 'nullable|url',
    ]);

    try {
        // Update data katalog
        $katalog->fill($validatedData);

        // Handle gambar perangkat
        if ($request->hasFile('gambar_perangkat')) {
            // Hapus gambar lama jika ada
            if ($katalog->gambar_perangkat) {
                Storage::disk('public')->delete($katalog->gambar_perangkat);
            }
            $image = $request->file('gambar_perangkat');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $katalog->gambar_perangkat = $name;
        }

        // Handle brand
        if ($request->brand === 'lainnya' && $request->filled('new_brand')) {
            $brand = $request->new_brand;
            $merkCatalog = MerkCatalog::firstOrCreate(['merk_nama' => $brand]);
            $katalog->brand = $merkCatalog->merk_nama;
        } else {
            $katalog->brand = $request->brand;
        }

        // Simpan perubahan pada katalog
        $katalog->save();

        // Redirect dengan pesan sukses
        return redirect()->route('viewkatalog')->with('success', 'Katalog berhasil diperbarui');
    } catch (\Exception $e) {
        // Jika terjadi error, redirect kembali dengan pesan error
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui katalog: ' . $e->getMessage()])->withInput();
    }
}



    public function destroy($id)
    {
        $katalog = Katalog::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($katalog->gambar_perangkat) {
            Storage::disk('public')->delete($katalog->gambar_perangkat);
        }

        $katalog->delete();

        return redirect()->route('viewkatalog')->with('success', 'Katalog berhasil dihapus');
    }
}
