<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function halamanlogin()
    {
        return view('login/login_web');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email Tidak Boleh Kosong !',
            'password.required' => 'Password Tidak Boleh Kosong !',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/home');
        }
        return redirect('login')->with('status', 'Email atau Password Salah !');
        // return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}//Last Code
