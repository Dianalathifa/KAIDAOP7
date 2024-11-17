<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HpsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.hps');
    }
}
