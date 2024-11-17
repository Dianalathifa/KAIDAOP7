<?php

namespace App\Http\Controllers;

use App\Models\LokasiCatalog;
use Illuminate\Http\Request;

class LokasiCatalogController extends Controller
{
    /**
     * Menampilkan form untuk membuat merk baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasis = LokasiCatalog::orderBy('id', 'desc')->get();
        $totallokasi = LokasiCatalog::count(); // Hitung total merk
        return view('admin.lokasitambah', compact('totallokasi'));
    }
    
    /**
     * Menampilkan daftar lokasi penyimpanan dan total lokasi.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lokasitotal = LokasiCatalog::count(); // Hitung total lokasi
        $katakunci = $request->katakunci;

        if (!empty($katakunci)) {
            $lokasis = LokasiCatalog::where('lokasi_penyimpanan', 'like', "%$katakunci%")
                                    ->orWhere('lokasi_deskripsi', 'like', "%$katakunci%")
                                    ->paginate(10);
        } else {
            $lokasis = LokasiCatalog::orderBy('lokasi_id', 'desc')->paginate(10); // Batasi 10 item per halaman
        }

        return view('admin.lokasiview', ['Data' => $lokasis], compact('lokasitotal'));
    }

    
    

    /**
     * Menyimpan lokasi penyimpanan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi_penyimpanan' => 'required|string|max:255',
            'lokasi_deskripsi' => 'nullable|string',
        ]);

        try {
            // Menambahkan data baru ke database
            LokasiCatalog::create($request->all());

            // Redirect dengan pesan sukses
            return redirect()->route('lokasi')->with('success', 'Lokasi penyimpanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('lokasi')->with('error', 'Gagal menambahkan lokasi penyimpanan.');
        }
    }

    /**
     * Menampilkan form untuk mengedit lokasi penyimpanan yang ada.
     *
     * @param  \App\Models\LokasiCatalog  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiCatalog $lokasi)
    {
        return view('admin.lokasiedit', compact('lokasi'));
    }

    /**
     * Memperbarui data lokasi penyimpanan di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $lokasi_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lokasi_id)
    {
        $request->validate([
            'lokasi_penyimpanan' => 'required|string|max:255',
            'lokasi_deskripsi' => 'nullable|string',
        ]);

        try {
            // Temukan lokasi berdasarkan lokasi_id
            $lokasi = LokasiCatalog::findOrFail($lokasi_id);

            // Perbarui data lokasi
            $lokasi->update($request->only(['lokasi_penyimpanan', 'lokasi_deskripsi']));

            // Redirect dengan pesan sukses
            return redirect()->route('lokasi')->with('success', 'Lokasi penyimpanan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('lokasi')->with('error', 'Gagal memperbarui lokasi penyimpanan.');
        }
    }

    /**
     * Menghapus lokasi penyimpanan dari database.
     *
     * @param  \App\Models\LokasiCatalog  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiCatalog $lokasi)
    {
        try {
            $lokasi->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('lokasi')->with('success', 'Lokasi penyimpanan berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('lokasi')->with('error', 'Gagal menghapus lokasi penyimpanan.');
        }
    }
}
