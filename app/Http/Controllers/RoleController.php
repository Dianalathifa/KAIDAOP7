<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        
        $roles = Role::all();
        return view('role.indexrole', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('role.tambahrole', compact('roles'));
    }

    public function store(Request $request)
{
    

    $request->validate([
        'role' => 'required|string|max:255',
    ]);

    Role::create([
        'name' => $request->role,
    ]);
    
    return redirect()->route('indexrole')->with('success', 'Role created successfully.');
}


    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,role,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->role
        ]);
        Role::where('name',$role)->update();
        return redirect()->to(' indexrole')->with('success', 'Berhasil edit data');
    }

    public function destroy($role)
    {
        Role::where('name',$role)->delete();
        return redirect()->to('indexrole')->with('success','Berhasil Melakukan delete');
    }
}

