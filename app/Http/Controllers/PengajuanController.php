<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data()
    {
        $pengajuans_datas = DB::table('tb_pengajuan_brg')
            ->select('tb_pengajuan_brg.id_pengajuan', 'tb_pengajuan_brg.tgl_pengajuan', 'users.name', 'tb_pengajuan_brg.status_pengajuan', 'tb_pengajuan_brg.user_pengaju','tb_pengajuan_brg.judul')
            ->leftJoin('users', 'tb_pengajuan_brg.user_pengaju', '=', 'users.id')
            ->where('users.role', 'user')
            ->distinct()
            ->orderBy('tb_pengajuan_brg.id_pengajuan','desc')
            ->get();
        return view('user/pengajuan/data', compact('pengajuans_datas'));
    }

    public function cek_file($id_pengajuan)
    {
        $pengajuann = DB::table('tb_pengajuan_brg')->where('id_pengajuan', $id_pengajuan)->first();
        return view('user/pengajuan/cek_file', compact('pengajuann'));
    }

    public function add()
    {
        $kode = Pengajuan::kode();
        $barangs = DB::table('tb_barang')->where('stok', '>' , 0)->get();
        return view('user/pengajuan/add', compact('kode','barangs'));
    }

    public function addProcess(Request $request)
    {
        $imageN = $request->file_pengajuan->getClientOriginalName();
        $request->file_pengajuan->move(public_path('pengajuan'), $imageN);

        $count_items = count($request->barang);
        for($i = 0; $i < $count_items; $i++) 
        {
            //Insert Ke TB_PENGAJUAN
            DB::table('tb_pengajuan_brg')->insert([
                'id_pengajuan' => $request->id_pengajuan,
                'user_pengaju' => $request->user_pengaju,
                'status_pengajuan' => 1,
                'file_pengajuan' => $imageN,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'barang' => $request->barang[$i],
                'jumlah' => $request->jumlah[$i],
                'id_perencanaan_pj' => 0,
                'judul' => $request->judul,
            ]);

            //Update Ke TB_BARANG
            // DB::table('tb_barang')->where('id_barang', $request->barang[$i])
            //     ->decrement('stok', $request->jumlah[$i]);
        }

        DB::table('tb_history')->insert([
            'h_id_pengajuan' => $request->id_pengajuan,
            'h_tgl_pengajuan' => $request->tgl_pengajuan,
            'h_user_pengaju' => $request->user_pengaju,
            'h_judul_pengajuan' => $request->judul,
            'h_status_pengajuan' => 1,
            'h_tgl_setuju' => 0
        ]);

        return redirect('user/pengajuan')->with('status', 'Data Berhasil diTambah !');
    }

    public function cek_barang($id_pengajuan)
    {
        $pengajuanss = DB::table('tb_pengajuan_brg')->where('id_pengajuan', $id_pengajuan)
                        ->leftJoin('tb_barang', 'tb_pengajuan_brg.barang', '=', 'tb_barang.id_barang')
                        ->get();
        // $id_pengajuans = $id_pengajuan;

        $juduls = DB::table('tb_pengajuan_brg')
            ->select('tb_pengajuan_brg.judul')
            ->where('id_pengajuan', $id_pengajuan)
            ->distinct()
            ->first();
        
        return view('user/pengajuan/cek_barang', compact('pengajuanss','id_pengajuan', 'juduls'));
    }

    //Bagian Staf
    public function staf_data($roles)
    {
        $pengajuans_datas = DB::table('tb_pengajuan_brg')
            ->select('tb_pengajuan_brg.id_pengajuan', 'tb_pengajuan_brg.tgl_pengajuan', 'users.name', 'tb_pengajuan_brg.status_pengajuan', 'tb_pengajuan_brg.user_pengaju', 'tb_pengajuan_brg.id_perencanaan_pj', 'tb_pengajuan_brg.judul')
            ->leftJoin('users', 'tb_pengajuan_brg.user_pengaju', '=', 'users.id')
            ->where('users.role', $roles)
            ->distinct()
            ->orderBy('tb_pengajuan_brg.id_pengajuan','desc')
            ->get();
        return view('staf/staf_pengajuan/data', compact('pengajuans_datas','roles'));
    }

    public function staf_cek_file($id_pengajuan)
    {
        $pengajuann = DB::table('tb_pengajuan_brg')->where('id_pengajuan', $id_pengajuan)->first();
        return view('staf/staf_pengajuan/cek_file', compact('pengajuann'));
    }

    public function cek_data($roles, $id_pengajuan)
    {
        $data_diris = DB::table('tb_pengajuan_brg')
            ->select('tb_pengajuan_brg.id_pengajuan', 'tb_pengajuan_brg.tgl_pengajuan', 'users.name', 'tb_pengajuan_brg.file_pengajuan', 'tb_pengajuan_brg.id_perencanaan_pj', 'tb_pengajuan_brg.judul', 'tb_pengajuan_brg.user_pengaju')
            ->leftJoin('users', 'tb_pengajuan_brg.user_pengaju', '=', 'users.id')
            ->where('id_pengajuan', $id_pengajuan)
            ->distinct()
            ->first();

        $data_pengajuans = DB::table('tb_pengajuan_brg')
            ->join('tb_barang', 'tb_pengajuan_brg.barang', '=', 'tb_barang.id_barang')
            ->where('id_pengajuan', $id_pengajuan)
            ->get();
        return view('staf/staf_pengajuan/cek_data', compact('data_pengajuans','data_diris', 'roles'));
    }

    public function staf_addProcess(Request $request, $roles, $id_pengajuan)
    {
        // $roles = 'user';
        switch ($request->input('action')) {
            case 'tolak':
                // Tolak [Start]
                DB::table('tb_pengajuan_brg')->where('id_pengajuan', $id_pengajuan)->update([
                    'keterangan' => $request->keterangan,
                    'status_pengajuan' => 4
                ]);

                DB::table('tb_history')->insert([
                    'h_id_pengajuan' => $request->id_pengajuan,
                    'h_tgl_pengajuan' => $request->tgl_pengajuan,
                    'h_user_pengaju' => $request->user_pengaju,
                    'h_judul_pengajuan' => $request->judul_pengajuan,
                    'h_status_pengajuan' => 4,
                    'h_user_penyetuju' => $request->h_user_penyetuju,
                    'h_tgl_setuju' => $request->tgl_balasan
                ]);
        
                return redirect('staf/staf_pengajuan/' .$roles)->with('status', 'Data Berhasil diUpdate !');
                // Tolak [End]
                break;

            case 'process':
                // Process [Start]
                DB::table('tb_pengajuan_brg')->where('id_pengajuan', $id_pengajuan)->update([
                    'keterangan' => $request->keterangan,
                    'status_pengajuan' => 2
                ]);

                DB::table('tb_history')->insert([
                    'h_id_pengajuan' => $request->id_pengajuan,
                    'h_tgl_pengajuan' => $request->tgl_pengajuan,
                    'h_user_pengaju' => $request->user_pengaju,
                    'h_judul_pengajuan' => $request->judul_pengajuan,
                    'h_status_pengajuan' => 2,
                    'h_user_penyetuju' => $request->h_user_penyetuju,
                    'h_tgl_setuju' => $request->tgl_balasan
                ]);
        
                return redirect('staf/staf_pengajuan/' .$roles)->with('status', 'Data Berhasil diUpdate !');
                // Process [End]
                break;
        }
    }

    public function approval($id_pengajuan)
    {
        $data_diris = DB::table('tb_pengajuan_brg')
            ->select('tb_pengajuan_brg.id_pengajuan', 'tb_pengajuan_brg.tgl_pengajuan', 'users.name', 'tb_pengajuan_brg.file_pengajuan', 'tb_pengajuan_brg.id_perencanaan_pj', 'tb_pengajuan_brg.judul', 'tb_pengajuan_brg.keterangan', 'tb_pengajuan_brg.status_pengajuan')
            ->leftJoin('users', 'tb_pengajuan_brg.user_pengaju', '=', 'users.id')
            ->where('id_pengajuan', $id_pengajuan)
            ->distinct()
            ->first();

        $data_pengajuans = DB::table('tb_pengajuan_brg')
            ->join('tb_barang', 'tb_pengajuan_brg.barang', '=', 'tb_barang.id_barang')
            ->where('id_pengajuan', $id_pengajuan)
            ->get();
        return view('staf/staf_pengajuan/approval', compact('data_pengajuans','data_diris'));
    }

    public function staf_cek_file_balasan($id_pengajuan)
    {
        $pengajuann = DB::table('tb_pengajuan_brg')->where('id_pengajuan', $id_pengajuan)->first();
        return view('staf/staf_pengajuan/cek_file_balasan', compact('pengajuann'));
    }

    public function export($roles)
    {
        $pengajuans_datas = DB::table('tb_pengajuan_brg')
            ->select('tb_pengajuan_brg.id_pengajuan', 'tb_pengajuan_brg.tgl_pengajuan', 'users.name', 'tb_pengajuan_brg.status_pengajuan', 'tb_pengajuan_brg.user_pengaju', 'tb_pengajuan_brg.id_perencanaan_pj', 'tb_pengajuan_brg.judul')
            ->leftJoin('users', 'tb_pengajuan_brg.user_pengaju', '=', 'users.id')
            ->where('users.role', $roles)
            // ->where('users.role', 'user')
            // ->orWhere('users.role', 'staf')
            ->distinct()
            ->orderBy('tb_pengajuan_brg.id_pengajuan','desc')
            ->get();
        return view('staf/staf_pengajuan/export', compact('pengajuans_datas', 'roles'));
        // return view('staf/staf_pengajuan/export')->with('pengajuans_datas', $pengajuans_datas);
    }
    //Last Code
}
