<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function login()
    {
        return view('auth.login');
    }
    function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('/dashboard');
        } else{
            return back()->with('/status', 'Email atau Password salah!');
        }
    }
    function logout()
    {
        Auth::logout();

        return view('auth.login');
    }
}
