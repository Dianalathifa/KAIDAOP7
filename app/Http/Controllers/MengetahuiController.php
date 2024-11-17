<?php

namespace App\Http\Controllers;

use App\Models\Mengetahui;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MengetahuiController extends Controller
{ public function index(Request $request)
      
    {
        $katakunci = $request->katakunci;
       
    
        if (!empty($katakunci)) {
            $validatedData = Mengetahui::where('NIPP', 'like', "%$katakunci%")
                                ->orWhere("nama", "like", "%$katakunci%")
                                ->orWhere("jabatan", "like", "%$katakunci%")
                                ->get();
        } else {
            $validatedData = Mengetahui::orderBy('NIPP', 'desc')->get();
        } 
    return view('mengetahui.viewmengetahui', ['Data' => $validatedData]);
    }
public function create()
{
    $validatedData = Mengetahui::orderBy('NIPP', 'desc')->get();
    
    return view('mengetahui.tambahmengetahui', ['Data' => $validatedData]);
}


public function store(Request $request)
{
    // Mengambil semua mengetahui untuk diurutkan berdasarkan NIPP secara descending
    $validatedData = Mengetahui::orderBy('NIPP','desc')->get();
    
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
        // Menambahkan mengetahui ke database
        Mengetahui::create($validatedData);

        // Commit transaksi jika tidak ada error
        DB::commit();
        
        // Redirect ke halaman viewmengetahui dengan pesan sukses
        return redirect('/viewmengetahui')->with('success', 'Berhasil menambahkan mengetahui');
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
    $validatedData = Mengetahui::where('NIPP', $id)->first();
    return view('mengetahui.editmengetahui', ['Data' => $validatedData]);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{   
    $request->setMethod('PUT');
    $validatedData = Mengetahui::orderBy('NIPP','desc')->get();
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
    Mengetahui::where('NIPP', $id)->update($validatedData);
    return redirect('viewmengetahui')->with('success', 'Berhasil edit data');    
}

/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    Mengetahui::where('NIPP', $id)->delete();
    return redirect()->to('viewmengetahui')->with('success','Berhasil Melakukan delete');
}
}

