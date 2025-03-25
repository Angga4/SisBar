<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            return $user->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('guru.dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        Cookie::queue(Cookie::forget('user_email'));

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    public function manualLogout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
