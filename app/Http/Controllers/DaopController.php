<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\daop;

class DaopController extends Controller
{
    public function index()
    {
        
        $daop = daop::all();
        return view('daop.viewdaop', compact('daop'));
    }

    public function create()
    {
        $daop = daop::all();
        return view('daop.tambahdaop', compact('daop'));
    }

    public function store(Request $request)
{
    $request->validate([
        'namadaop' => 'required|string|max:255',
    ]);

    daop::create([
        'namadaop' => $request->namadaop,
    ]);
    
    return redirect()->route('viewdaop')->with('success', 'Daop created successfully.');
}


public function edit(String $id)
{
   
    $item = daop::where('namadaop',$id)->firstOrFail();
    return view('daop.editdaop', ['Data' => $item]);
}
public function update(Request $request,String $id)
{
    $request->setMethod('PUT');
    $daop = daop::orderBy('namadaop','desc')->get();
    $request->validate([
        'namadaop' => 'required|string|max:255',
    ]);

    $daop = daop::where('namadaop', $id)->firstOrFail();
    $daop->update([
        'namadaop' => $request->namadaop
    ]);

    return redirect()->route('viewdaop')->with('success', 'Berhasil edit data');
}

public function destroy($namadaop)
{
    $daop = daop::where('namadaop', $namadaop)->firstOrFail();
    $daop->delete();
    return redirect()->route('viewdaop')->with('success', 'Berhasil Melakukan delete');
}
}

