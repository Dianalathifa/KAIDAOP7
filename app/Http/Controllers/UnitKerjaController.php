<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitKerja;
use App\Models\Daop;

class UnitKerjaController extends Controller
{
    
    public function index()
    {
        
        $unit = UnitKerja ::all();
        return view('unitkerja.viewunit', compact('unit'));
    }

    public function create()
    {
        $daops = Daop::all();
        $unit = Unitkerja::all();
        return view('unitkerja.tambahunit', compact('unit','daops'));
    }

    public function store(Request $request)
{
    $request->validate([
        'Nama_Unit' => 'required|string|max:255',
        'DAOP' => 'required|string|max:255',
    ]);

    UnitKerja::create([
        'Nama_Unit' => $request->Nama_Unit,
        'DAOP' => $request->DAOP,
    ]);
    
    return redirect()->route('viewunit')->with('success', 'Unit Kerja created successfully.');
}

public function edit(string $id)
{
    $Nama_Unit = UnitKerja::where('Nama_Unit', $id)->first();
    return view('unitkerja.editunit', ['Data' => $Nama_Unit]);
}
public function update(Request $request, UnitKerja $Nama_Unit)
{
    $request->validate([
        'Nama_Unit' => 'required|string|max:255',
        'DAOP' => 'required|string|max:255',
    ]);

    $Nama_Unit->update([
        'Nama_Unit' => $request->Nama_Unit,
        'DAOP' => $request->DAOP,
    ]);
    
    UnitKerja::where('Nama_Unit',$Nama_Unit)->update();
    return redirect()->to('viewunit')->with('success', 'Berhasil edit data');
}

public function destroy($Nama_Unit)
{
    UnitKerja::where('Nama_Unit',$Nama_Unit)->delete();
    return redirect()->to('viewunit')->with('success','Berhasil Melakukan delete');
}
}
