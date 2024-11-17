<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function TentangKami()
    {
        return view('home.TentangKami');
    }

    public function strukturorganisasi()
    {
        return view('home.struktur');
    }
    public function visimisi()
    {
        return view('home.visimisi');
    }
    public function tugaspokok()
    {
        return view('home.tugaspokok');
    }
    public function petawilayahkerja()
    {
        return view('home.petawilayahkerja');
    }
    

}
