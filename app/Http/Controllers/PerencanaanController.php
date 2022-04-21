<?php

namespace App\Http\Controllers;

use App\Models\Perencanaan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class PerencanaanController extends Controller
{
    public function data()
    {
        $perencanaans_datas = DB::table('tb_perencanaan_brg')
            ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.file_perencana')
            ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->distinct()
            ->get();
        return view('staf/perencanaan/data', compact('perencanaans_datas'));
    }

    public function add()
    {
        $kode = Perencanaan::kode();
        // $barangs = DB::table('tb_barang')->where('stok', '>' , 0)->get();
        $barangs = DB::table('tb_barang')->get();
        $barang_dikit = DB::table('tb_barang')->orderBy('stok', 'asc')->paginate(3);
        $barang_banyak = DB::table('tb_perencanaan_brg')
            ->select(DB::raw('sum(jumlah_p) as jmlh, barang_p, nama_barang'))
            ->leftJoin('tb_barang', 'tb_perencanaan_brg.barang_p', '=', 'tb_barang.id_barang')
            ->groupBy('barang_p','nama_barang')
            ->orderBy('jmlh', 'desc')
            ->paginate(3);
        return view('staf/perencanaan/add', compact('kode','barangs','barang_dikit','barang_banyak'));
    }

    public function addProcess(Request $request)
    {
        $imageN = $request->file_perencana->getClientOriginalName();
        $request->file_perencana->move(public_path('perencanaan'), $imageN);

        $count_items = count($request->barang_p);
        for($i = 0; $i < $count_items; $i++) 
        {
            //Insert Ke TB_PERENCANAAN_BRG
            DB::table('tb_perencanaan_brg')->insert([
                'id_perencanaan' => $request->id_perencanaan,
                'user_perencana' => $request->user_perencana,
                'status_perencana' => 1,
                'file_perencana' => $imageN,
                'tgl_perencanaan' => $request->tgl_perencanaan,
                'judul_perencanaan' => $request->judul_perencanaan,
                'barang_p' => $request->barang_p[$i],
                'jumlah_p' => $request->jumlah_p[$i]
            ]);
        }

        return redirect('staf/perencanaan')->with('status', 'Data Berhasil diTambah !');
    }

    public function cek_file($id_perencana)
    {
        $perencanaans = DB::table('tb_perencanaan_brg')->where('id_perencanaan', $id_perencana)->first();
        return view('staf/perencanaan/cek_file', compact('perencanaans'));
    }

    public function cek_file_balasan($id_perencana)
    {
        $perencanaans = DB::table('tb_perencanaan_brg')->where('id_perencanaan', $id_perencana)->first();
        return view('staf/perencanaan/cek_file_balasan', compact('perencanaans'));
    }

    public function cek_brg($id_perencanaan)
    {
        // $kode_staf = Pengajuan::kode_staf();
        $data_diris = DB::table('tb_perencanaan_brg')
            ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.file_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.keterangan', 'tb_perencanaan_brg.file_balasan')
            ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            // ->leftJoin('tb_pengajuan_brg', 'tb_perencanaan_brg.id_perencanaan', '=', 'tb_pengajuan_brg.id_perencanaan_pj')
            ->where('id_perencanaan', $id_perencanaan)
            ->distinct()
            ->first();

        $data_perancanaans = DB::table('tb_perencanaan_brg')
            ->join('tb_barang', 'tb_perencanaan_brg.barang_p', '=', 'tb_barang.id_barang')
            ->where('id_perencanaan', $id_perencanaan)
            ->get();

        return view('staf/perencanaan/cek_brg', compact('data_perancanaans','data_diris'));
    }

    public function addProcessAjukan(Request $request)
    {
        $name_file = $request->file_perencana;

        $count_items = count($request->barang_p);
        for($i = 0; $i < $count_items; $i++) 
        {
            //Insert Ke TB_PENGAJUAN
            DB::table('tb_pengajuan_brg')->insert([
                'id_pengajuan' => $request->id_pengajuan,
                'user_pengaju' => $request->user_perencana,
                'status_pengajuan' => 2,
                'file_pengajuan' => $request->file_perencana,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'barang' => $request->barang_p[$i],
                'jumlah' => $request->jumlah_p[$i],
                'id_perencanaan_pj' => $request->id_perencanaan,
                'judul' => $request->judul
            ]);
        }
        
        DB::table('tb_history')->insert([
            'h_id_pengajuan' => $request->id_pengajuan,
            'h_tgl_pengajuan' => $request->tgl_pengajuan,
            'h_user_pengaju' => $request->user_perencana,
            'h_judul_pengajuan' => $request->judul,
            'h_status_pengajuan' => 2,
            'h_tgl_setuju' => 0
        ]);


        File::copy(public_path('perencanaan/' .$name_file), public_path('pengajuan/' .$name_file));

        DB::table('tb_perencanaan_brg')->where('id_perencanaan', $request->id_perencanaan)->update([
            'status_perencana' => 2
        ]);

        return redirect('staf/perencanaan')->with('status', 'Data Berhasil diAjukan !');
    }

    public function export()
    {
        $perencanaans_datas = DB::table('tb_perencanaan_brg')
            ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana')
            ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->distinct()
            ->get();
        return view('staf/perencanaan/export', compact('perencanaans_datas'));
    }

    public function delete($id_perencanaan, $files_perencana)
    {
        $destinationPath = 'perencanaan';
        File::delete($destinationPath.'/'.$files_perencana);

        DB::table('tb_perencanaan_brg')->where('id_perencanaan', $id_perencanaan)->delete();
        return redirect('staf/perencanaan')->with('status', 'Data Berhasil diHapus !');
    }

    // Lapporan Perencanaan [Start]
    public function data_laporan()
    {
        $datecari = '';
        $perencanaans_datas = DB::table('tb_perencanaan_brg')
            ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.file_perencana')
            ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->distinct()
            ->get();
        return view('staf/laporan/perencanaan/data', compact('perencanaans_datas','datecari'));
    }

    public function perencanaan_aksi(Request $request)
    {
        switch ($request->input('action')) {
            case 'cari':
                // Cari Data [Start]
                    $request->validate([
                        'periode' => 'required',
                    ], [
                        'periode.required' => 'Periode Tidak Boleh Kosong !',
                    ]);

                    $datecari = $request->periode;
                    $from = Str::substr($request->periode, 0, 10);
                    $to = Str::substr($request->periode, 13);
                    $perencanaans_datas = DB::table('tb_perencanaan_brg')
                    ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.file_perencana')
                    ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
                    ->whereDate('tgl_perencanaan','>=', $from)
                    ->whereDate('tgl_perencanaan','<=', $to)
                    ->distinct()
                    ->get();
                    return view('staf/laporan/perencanaan/data', compact('from','to','perencanaans_datas','datecari'));
                // Cari Data [End]
                break;

            case 'refresh':
                // Refresh Data [Start]
                    $datecari = '';
                    $perencanaans_datas = DB::table('tb_perencanaan_brg')
                    ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.file_perencana')
                    ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
                    ->distinct()
                    ->get();
                    return view('staf/laporan/perencanaan/data', compact('perencanaans_datas','datecari'));
                // Refresh Data [End]
                break;

            case 'convert':
                // Cetak Data [Start]
                if ($request->periode == "") {
                    $perencanaans_datas = DB::table('tb_perencanaan_brg')
                    ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.file_perencana')
                    ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
                    ->distinct()
                    ->get();
                    return view('staf/laporan/perencanaan/laporan', compact('perencanaans_datas'));
                    
                } else {
                    $from = Str::substr($request->periode, 0, 10);
                    $to = Str::substr($request->periode, 13);
                    $perencanaans_datas = DB::table('tb_perencanaan_brg')
                    ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.file_perencana')
                    ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
                    ->whereDate('tgl_perencanaan','>=', $from)
                    ->whereDate('tgl_perencanaan','<=', $to)
                    ->distinct()
                    ->get();
                    return view('staf/laporan/perencanaan/laporan', compact('perencanaans_datas'));
                }
                    
                // Cetak Data [End]
                break;
        }
    }

    public function cek_file_laporan($id_perencanaan)
    {
        // $kode_staf = Pengajuan::kode_staf();
        $data_perancanaans = DB::table('tb_perencanaan_brg')
            ->join('tb_barang', 'tb_perencanaan_brg.barang_p', '=', 'tb_barang.id_barang')
            ->join('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->where('id_perencanaan', $id_perencanaan)
            ->get();

        return view('staf/laporan/perencanaan/detail', compact('data_perancanaans'));
    }
    // Lapporan Perencanaan [End]
    //Last_Code
}
