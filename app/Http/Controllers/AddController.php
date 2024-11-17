<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserActivityLog;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $validatedData = User::orderBy('NIPP', 'desc')->get();
        $roles = Role::all(); // Ambil semua role dari tabel roles
        return view('admin.adduser', ['Data' => $validatedData, 'roles' => $roles]);
    }
    

    public function activityLog()
    {
        // Ambil semua log activity dari database
        $logs = UserActivityLog::all();

        // Kirim data logs ke view
        return view('admin.user_activity_log', compact('logs'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $katakunci = $request->katakunci;
        $roles = Role::all(); // Ambil semua role dari tabel roles
    
        if (!empty($katakunci)) {
            $validatedData = User::where('NIPP', 'like', "%$katakunci%")
                                ->orWhere("name", "like", "%$katakunci%")
                                ->orWhere("role", "like", "%$katakunci%")
                                ->get();
        } else {
            $validatedData = User::orderBy('NIPP', 'desc')->get();
        }
        
        return view('admin.viewuser', ['Data' => $validatedData, 'roles' => $roles]);
    }
    
    
    public function store(Request $request)
    {
        // Mengambil semua user untuk diurutkan berdasarkan NIPP secara descending
        $validatedData = User::orderBy('NIPP','desc')->get();
        
        // Menyimpan data request ke dalam session
        Session::flash('NIPP', $request->NIPP);
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        Session::flash('role', $request->role);
        
        // Melakukan validasi input
        $request->validate([
            'NIPP' => 'required|integer|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:255',
        ], [
            'NIPP.required' => 'NIPP wajib diisi',
            'NIPP.integer' => 'NIPP harus berupa angka',
            'NIPP.unique' => 'NIPP sudah terdaftar',
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib diisi',
        ]);
        
        // Membuat array data yang sudah divalidasi
        $validatedData = [
            'NIPP' => $request->NIPP,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ];
        
        DB::beginTransaction();
        
        try {
            // Menambahkan user ke database
            User::create($validatedData);
    
            // Commit transaksi jika tidak ada error
            DB::commit();
            
            // Redirect ke halaman viewuser dengan pesan sukses
            return redirect('/viewuser')->with('success', 'Berhasil menambahkan user');
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
        $validatedData = User::where('NIPP', $id)->first();
        $roles = Role::all(); // Ambil semua role dari tabel roles
        return view('admin.edit', ['Data' => $validatedData, 'roles' => $roles]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->setMethod('PUT');
        $validatedData = User::orderBy('NIPP','desc')->get();
        $request->validate([
            'NIPP' => 'required|integer',
            'name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:255',
        ],[
            'NIPP.required' => 'NIPP wajib diisi',
            'NIPP.integer' => 'NIPP harus berupa angka',
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib diisi',
        ]);
        
        $validatedData = [
            'NIPP' => $request->NIPP,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::where('NIPP', $id)->update($validatedData);
        return redirect('viewuser')->with('success', 'Berhasil edit data');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('NIPP', $id)->delete();
        return redirect()->to('viewuser')->with('success','Berhasil Melakukan delete');
    }
}
