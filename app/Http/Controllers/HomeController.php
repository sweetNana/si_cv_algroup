<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data()
    {
        $perencanaans = DB::table('tb_perencanaan_brg')->count(DB::raw('DISTINCT id_perencanaan'));
        $barangs = DB::table('tb_barang')->count();
        $users = DB::table('users')->count();
        $suppliers = DB::table('tb_supplier')->count();
        //dd($kategori);
        return view('home', compact('perencanaans','barangs','users','suppliers'));
    }
} //Last Code
