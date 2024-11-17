<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpkController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.spk');
    }
}
