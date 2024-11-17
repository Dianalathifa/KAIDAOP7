<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RabController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.rab');
    }
     
    public function listrab(Request $request)
    {
        return view('admin.listrab');
    }
}
