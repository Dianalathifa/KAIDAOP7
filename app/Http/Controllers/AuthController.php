<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class AuthController extends Controller
{
    public function showLoginForm()
{
    return view('auth.login');
}

    public function login(Request $request){
        $request->validate([
        'NIPP' => 'required',
        'password'=> 'required'
    ],[
        'NIPP.required'=> 'NIPP tidak tersedia',
        'password.required'=> 'Password salah'
    ]);
    
    $credentials = [
        'NIPP'=> $request->NIPP,
        'password'=> $request->password
    ];

    if (Auth::attempt($credentials)) {
        Log::info('User logged in successfully: ' . Auth::user()->NIPP);
        return redirect()->intended('/dashboard');
    } else {
        return redirect('login')->withErrors('NIPP dan password tidak tersedia')->withInput();
    }
}

  
    public function logout(Request $request)
    {
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
}