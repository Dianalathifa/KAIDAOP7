<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;


class AdminController extends Controller
{
    public function admin()
    {
        $title = Home::all();
        return view('home.adminhome', compact('title'));
    }
    public function create(Request $request)
    {
        $title = Home::all();
        return view('home.addhome', compact('title'));
    }
    public function admindb(Request $request)
    {
        return view('home.admindb');
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|text|max:255',
        'image' => 'required|string|max:255',
    ]);

    Home::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $request->image,
    ]);
    
    return redirect()->route('adminhome')->with('success', ' Berhasil.');
}


public function edit($title)
{
    $item = Home::where('namadaop', $title)->firstOrFail();
    return view('daop.editdaop', compact('item'));
}
public function update(Request $request, $title)
{
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    $title = Home::where('title', $title)->firstOrFail();
    $title->update([
        'title' => $request->title
    ]);

    return redirect()->route('adminhome')->with('success', 'Berhasil edit data');
}

public function destroy($title)
{
    $daop = Home::where('title', $title)->firstOrFail();
    $daop->delete();
    return redirect()->route('adminhome')->with('success', 'Berhasil Melakukan delete');
}

}