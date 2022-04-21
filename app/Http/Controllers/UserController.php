<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function data()
    {
        $users = DB::table('users')->get();
        return view('staf/user/data')->with('users', $users);;
    }

    public function add()
    {
        return view('staf/user/add');
    }

    public function addProcess(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Nama User Tidak Boleh Kosong !',
            'role.required' => 'Role Tidak Boleh Kosong !',
            'email.required' => 'Email Tidak Boleh Kosong !',
            'password.required' => 'Password Tidak Boleh Kosong !',
        ]);

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        
        return redirect('staf/user')->with('status', 'Data Berhasil diTambah !');
    }

    public function delete($id_user)
    {
        DB::table('users')->where('id', $id_user)->delete();
        return redirect('staf/user')->with('status', 'Data Berhasil diHapus !');
    }
    //Last Code
}
