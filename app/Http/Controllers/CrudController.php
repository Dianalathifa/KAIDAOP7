<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function tambah(Request $request)
    {
        return view('layout.crud.tambah');
    }
}
