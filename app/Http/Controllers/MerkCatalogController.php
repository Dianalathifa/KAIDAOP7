<?php

namespace App\Http\Controllers;

use App\Models\MerkCatalog;
use Illuminate\Http\Request;

class MerkCatalogController extends Controller
{
    /**
     * Menampilkan form untuk membuat merk baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merks = MerkCatalog::orderBy('id', 'desc')->get();
        $merktotal = MerkCatalog::count(); // Hitung total merk
        return view('admin.merktambah', compact('merktotal'));
    }
    
    /**
     * Menampilkan daftar semua merk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $merktotal = MerkCatalog::count(); // Hitung total merk
        $katakunci = $request->katakunci;

        if (!empty($katakunci)) {
            $merks = MerkCatalog::where('merk_id', 'like', "%$katakunci%")
                                ->orWhere('merk_nama', 'like', "%$katakunci%")
                                ->orWhere('merk_keterangan', 'like', "%$katakunci%")
                                ->paginate(10);
        } else {
            $merks = MerkCatalog::orderBy('merk_id', 'desc')->paginate(10); // Batasi 10 item per halaman
        }

        return view('admin.merkview', ['Data' => $merks],compact('merktotal'));

    }


    

    /**
     * Menyimpan merk baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'merk_nama' => 'required|string|max:255',
        'merk_keterangan' => 'nullable|string',
    ]);

    // Menambahkan data baru dan Laravel akan menangani created_at secara otomatis
    MerkCatalog::create($request->all());

    return redirect()->route('merk')->with('success', 'Merk berhasil ditambahkan.');
}


    /**
     * Menampilkan form untuk mengedit merk yang ada.
     *
     * @param  \App\Models\MerkCatalog  $merk
     * @return \Illuminate\Http\Response
     */
    public function edit(MerkCatalog $merk)
    {
        return view('edit', compact('merk'));
    }

    public function update(Request $request, $merk_id)
{
    // Validasi input
    $request->validate([
        'merk_nama' => 'required|string|max:255',
        'merk_keterangan' => 'nullable|string',
    ]);

    // Temukan merk berdasarkan merk_id
    $merk = MerkCatalog::findOrFail($merk_id);

    // Perbarui data merk
    $merk->update([
        'merk_nama' => $request->merk_nama,
        'merk_keterangan' => $request->merk_keterangan,
    ]);

    // Memperbarui timestamp secara manual
    $merk->updated_at = now();
    $merk->save();

    // Redirect dengan pesan sukses
    session()->flash('success', 'Data berhasil diupdate!');
    return redirect()->route('merk');
}



    /**
     * Menghapus merk dari database.
     *
     * @param  \App\Models\MerkCatalog  $merk
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerkCatalog $merk)
    {
        $merk->delete();

        return redirect()->route('merk')->with('success', 'Merk berhasil dihapus.');
    }
}
