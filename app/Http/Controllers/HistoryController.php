<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function data()
    {
        $pengajuans_datas = DB::table('tb_history')
            ->select('tb_history.h_id_pengajuan', 'tb_history.h_tgl_pengajuan', 'users.name', 'users.role', 'tb_history.h_status_pengajuan', 'tb_history.h_user_pengaju','tb_history.h_judul_pengajuan', 'tb_history.h_tgl_setuju')
            ->join('users', 'tb_history.h_user_pengaju', '=', 'users.id')
            ->distinct()
            ->orderBy('tb_history.h_id_pengajuan','desc')
            ->orderBy('tb_history.h_tgl_setuju','desc')
            ->get();
        return view('staf/history/data', compact('pengajuans_datas'));
    }
    //Last Code
}
