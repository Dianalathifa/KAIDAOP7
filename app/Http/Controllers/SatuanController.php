<?php

namespace App\Http\Controllers;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function create()
    {   
        $satuan = Satuan::orderBy('id', 'desc')->get();
        $satuantotal = Satuan::count();
        return view('admin.satuantambah', ['Data' => $satuan],compact('satuantotal'));
    }
    
    public function index(Request $request)
    {
        $satuantotal = Satuan::count();
        $katakunci = $request->katakunci;
       
    
        if (!empty($katakunci)) {
            $satuan = Satuan::where('id', 'like', "%$katakunci%")
                                ->orWhere("id", "like", "%$katakunci%")
                                ->orWhere("satuan", "like", "%$katakunci%")
                                ->get();
        } else {
            $satuan = Satuan::orderBy('id', 'desc')->get();
        }
        
        return view('admin.satuanview', ['Data' => $satuan],compact('satuantotal'));
    }
    
    
    public function store(Request $request)
    {
        // Mengambil semua user untuk diurutkan berdasarkan NIPP secara descending
        $satuan = Satuan::orderBy('id','desc')->get();
        
        // Menyimpan data request ke dalam session
        Session::flash('id', $request->id);
        Session::flash('satuan', $request->satuan);
        Session::flash('deskripsi', $request->deskripsi);
    
        
        // Melakukan validasi input
        $request->validate([
            'id' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);
        // Membuat array data yang sudah divalidasi
        $satuan = [
            'id' => $request->id,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
        ];
        
        DB::beginTransaction();
        
        try {
            // Menambahkan user ke database
            Satuan::create($satuan);
    
            // Commit transaksi jika tidak ada error
            DB::commit();
            
            // Redirect ke halaman viewuser dengan pesan sukses
            return redirect('/satuanview')->with('success', 'Berhasil menambahkan satuan');
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
        $item = Satuan::find($id); // Asumsi model Anda bernama Item
        if (!$item) {
            // Tangani kasus ketika item tidak ditemukan
            return redirect()->back()->withErrors('Item not found.');
        }
        return view('admin.satuanedit', compact('item')); 
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->setMethod('PUT');
        $satuan = Satuan::orderBy('id','desc')->get();
        $request->validate([
            'id' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);
        
        $satuan = [
            'id' => $request->id,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
        ];
        
       
        Satuan::where('id', $id)->update($satuan);
        return redirect('satuanview')->with('success', 'Berhasil edit satuan');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Satuan::where('id', $id)->delete();
        return redirect()->to('satuanview')->with('success','Berhasil Melakukan delete');
    }
}
