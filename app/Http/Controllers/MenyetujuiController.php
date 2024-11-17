<?php
namespace App\Http\Controllers;

use App\Models\Menyetujui;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MenyetujuiController extends Controller

    /**
     * Display a listing of the resource.
     */
   { public function index(Request $request)
      
        {
            $katakunci = $request->katakunci;
           
        
            if (!empty($katakunci)) {
                $validatedData = Menyetujui::where('NIPP', 'like', "%$katakunci%")
                                    ->orWhere("nama", "like", "%$katakunci%")
                                    ->orWhere("jabatan", "like", "%$katakunci%")
                                    ->get();
            } else {
                $validatedData = Menyetujui::orderBy('NIPP', 'desc')->get();
            } 
        return view('menyetujui.viewmenyetujui', ['Data' => $validatedData]);
        }
    public function create()
    {
        $validatedData = Menyetujui::orderBy('NIPP', 'desc')->get();
        
        return view('menyetujui.tambahmenyetujui', ['Data' => $validatedData]);
    }
    
    
    public function store(Request $request)
    {
        // Mengambil semua Menyetujui untuk diurutkan berdasarkan NIPP secara descending
        $validatedData = Menyetujui::orderBy('NIPP','desc')->get();
        
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
            // Menambahkan Menyetujui ke database
            Menyetujui::create($validatedData);
    
            // Commit transaksi jika tidak ada error
            DB::commit();
            
            // Redirect ke halaman viewMenyetujui dengan pesan sukses
            return redirect('/viewmenyetujui')->with('success', 'Berhasil menambahkan Menyetujui');
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
        $validatedData = Menyetujui::where('NIPP', $id)->first();
        return view('menyetujui.editmenyetujui', ['Data' => $validatedData]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->setMethod('PUT');
        $validatedData = Menyetujui::orderBy('NIPP','desc')->get();
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
        Menyetujui::where('NIPP', $id)->update($validatedData);
        return redirect('viewmenyetujui')->with('success', 'Berhasil edit data');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Menyetujui::where('NIPP', $id)->delete();
        return redirect()->to('viewmenyetujui')->with('success','Berhasil Melakukan delete');
    }
}

