<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembuatDokumen;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class PembuatController extends Controller
{ public function index(Request $request)
      
    {
        $katakunci = $request->katakunci;
       
    
        if (!empty($katakunci)) {
            $validatedData = PembuatDokumen::where('NIPP', 'like', "%$katakunci%")
                                ->orWhere("nama", "like", "%$katakunci%")
                                ->orWhere("jabatan", "like", "%$katakunci%")
                                ->get();
        } else {
            $validatedData = PembuatDokumen::orderBy('NIPP', 'desc')->get();
        } 
    return view('pembuatdokumen.viewdokumen', ['Data' => $validatedData]);
    }
public function create()
{
    $validatedData = PembuatDokumen::orderBy('NIPP', 'desc')->get();
    
    return view('pembuatdokumen.tambahdokumen', ['Data' => $validatedData]);
}


public function store(Request $request)
{
    // Mengambil semua PembuatDokumen untuk diurutkan berdasarkan NIPP secara descending
    $validatedData = PembuatDokumen::orderBy('NIPP','desc')->get();
    
    // Menyimpan data request ke dalam session
    Session::flash('NIPP', $request->NIPP);
    Session::flash('nama', $request->nama);
    Session::flash('jabatan', $request->jabatan);

    // Melakukan validasi input
    $request->validate([
        'NIPP' => 'required|integer',
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
    ], [
        'NIPP.required' => 'NIPP wajib diisi',
        'NIPP.integer' => 'NIPP harus berupa angka',
        'NIPP.unique' => 'NIPP sudah terdaftar',
        'nama.required' => 'Nama wajib diisi',
        'jabatan.required' => 'Jabatan wajib diisi',
    ]);
    
    // Membuat array data yang sudah divalidasi
    $validatedData = [
        'NIPP' => $request->NIPP,
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
       
    ];
    
    DB::beginTransaction();
    
    try {
        // Menambahkan PembuatDokumen ke database
        PembuatDokumen::create($validatedData);

        // Commit transaksi jika tidak ada error
        DB::commit();
        
        // Redirect ke halaman viewPembuatDokumen dengan pesan sukses
        return redirect('/viewdokumen')->with('success', 'Berhasil menambahkan PembuatDokumen');
    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi error
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

/**
 * Show the form for editing the specified resource.
 */
public function edit(string $id)
{
    $validatedData = PembuatDokumen::where('NIPP', $id)->first();
    return view('pembuatdokumen.editdokumen', ['Data' => $validatedData]);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{   
    $request->setMethod('PUT');
    $validatedData = PembuatDokumen::orderBy('NIPP','desc')->get();
    $request->validate([
        'NIPP' => 'required|integer',
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
    ], [
        'NIPP.required' => 'NIPP wajib diisi',
        'NIPP.integer' => 'NIPP harus berupa angka',
        'NIPP.unique' => 'NIPP sudah terdaftar',
        'nama.required' => 'Nama wajib diisi',
        'jabatan.required' => 'Jabatan wajib diisi',
    ]);
    
    // Membuat array data yang sudah divalidasi
    $validatedData = [
        'NIPP' => $request->NIPP,
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
       
    ];
    PembuatDokumen::where('NIPP', $id)->update($validatedData);
    return redirect('viewdokumen')->with('success', 'Berhasil edit data');    
}

/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    PembuatDokumen::where('NIPP', $id)->delete();
    return redirect()->to('viewdokumen')->with('success','Berhasil Melakukan delete');
}
}

