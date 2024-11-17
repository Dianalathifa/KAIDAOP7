<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klasifikasi;

class KlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci dari input pencarian
        $katakunci = $request->get('katakunci');
        
        // Query pencarian berdasarkan klasifikasi atau inisial dengan pagination
        $klasifikasi = Klasifikasi::when($katakunci, function($query, $katakunci) {
            return $query->where('klasifikasi', 'like', "%$katakunci%")
                         ->orWhere('inisial', 'like', "%$katakunci%");
        })->paginate(10); // Menggunakan pagination 10 item per halaman

        // Menampilkan view dengan hasil pencarian atau semua data
        return view('klasifikasi.viewklasifikasi', compact('klasifikasi'));
    }

    public function create()
    {
        return view('klasifikasi.tambahklasifikasi');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'klasifikasi' => 'required|string|max:255|unique:klasifikasi,klasifikasi',
            'inisial' => 'required|string|max:10',
        ]);

        // Membuat data baru
        Klasifikasi::create([
            'klasifikasi' => $request->klasifikasi,
            'inisial' => $request->inisial,
        ]);

        return redirect()->route('viewklasifikasi')->with('success', 'Klasifikasi berhasil dibuat.');
    }

    public function edit($id) {
    $klasifikasi = Klasifikasi::find($id); // Ambil data klasifikasi berdasarkan ID
    return response()->json($klasifikasi); // Return data dalam bentuk JSON
}

   public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'klasifikasi' => 'required',
        'inisial' => 'required',
    ]);

    // Cari data berdasarkan id
    $klasifikasi = Klasifikasi::find($id);
    
    // Update data
    $klasifikasi->klasifikasi = $request->klasifikasi;
    $klasifikasi->inisial = $request->inisial;

    // Simpan perubahan
    $klasifikasi->save();

    // Redirect ke halaman daftar klasifikasi dengan pesan sukses
    return redirect()->route('viewklasifikasi')->with('success', 'Klasifikasi berhasil diupdate');
}

public function destroy($id)
{
    // Temukan klasifikasi berdasarkan ID dan hapus
    $klasifikasi = Klasifikasi::findOrFail($id);
    $klasifikasi->delete();

    return redirect()->back()->with('success', 'Klasifikasi berhasil dihapus.');
}

}
