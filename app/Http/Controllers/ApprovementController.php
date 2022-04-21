<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data()
    {
        $perencanaans_datas = DB::table('tb_perencanaan_brg')
            ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan')
            ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->distinct()
            ->get();
        return view('ketua/approvement/data', compact('perencanaans_datas'));
    }

    public function approval($id_perencanaan)
    {
        $data_diris = DB::table('tb_perencanaan_brg')
            ->select('tb_perencanaan_brg.id_perencanaan', 'tb_perencanaan_brg.tgl_perencanaan', 'users.name', 'tb_perencanaan_brg.file_perencana', 'tb_perencanaan_brg.user_perencana', 'tb_perencanaan_brg.judul_perencanaan', 'tb_perencanaan_brg.status_perencana', 'tb_perencanaan_brg.keterangan', 'tb_perencanaan_brg.file_balasan')
            ->leftJoin('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->where('id_perencanaan', $id_perencanaan)
            ->distinct()
            ->first();

        $data_perancanaans = DB::table('tb_perencanaan_brg')
            ->join('tb_barang', 'tb_perencanaan_brg.barang_p', '=', 'tb_barang.id_barang')
            ->where('id_perencanaan', $id_perencanaan)
            ->get();
        return view('ketua/approvement/approval', compact('data_perancanaans','data_diris'));
    }

    // public function process($pilihan, $id_pengajuan)
    // {
    //     $data_diris = DB::table('tb_pengajuan_brg')
    //         ->select('tb_pengajuan_brg.id_pengajuan', 'tb_pengajuan_brg.tgl_pengajuan', 'users.name', 'tb_pengajuan_brg.file_pengajuan', 'tb_pengajuan_brg.id_perencanaan_pj', 'tb_pengajuan_brg.judul', 'tb_pengajuan_brg.status_pengajuan', 'tb_pengajuan_brg.user_pengaju')
    //         ->leftJoin('users', 'tb_pengajuan_brg.user_pengaju', '=', 'users.id')
    //         ->where('id_pengajuan', $id_pengajuan)
    //         ->distinct()
    //         ->first();

    //     $data_pengajuans = DB::table('tb_pengajuan_brg')
    //         ->join('tb_barang', 'tb_pengajuan_brg.barang', '=', 'tb_barang.id_barang')
    //         ->where('id_pengajuan', $id_pengajuan)
    //         ->get();
    //     return view('ketua/approvement/process', compact('data_pengajuans', 'data_diris', 'pilihan'));
    // }

    public function addProcess(Request $request, $id_perencanaan)
    {
        switch ($request->input('action')) {
            case 'simpanTerima':
                // Save Terima [Start]
                    $imageN = $request->file_balasan->getClientOriginalName();
                    $request->file_balasan->move(public_path('balasan'), $imageN);
            
                    DB::table('tb_perencanaan_brg')->where('id_perencanaan', $id_perencanaan)->update([
                        'status_perencana' => 2,
                        'keterangan' => $request->keterangan,
                        'file_balasan' => $imageN
                    ]);
            
                    return redirect('ketua/approvement')->with('status', 'Data Berhasil diProcess !');
                // Save Terima [End]
                break;

            case 'simpanTolak':
                // Save Belum Pernah Ada [Start]
                    $imageN = $request->file_balasan->getClientOriginalName();
                    $request->file_balasan->move(public_path('balasan'), $imageN);

                    DB::table('tb_perencanaan_brg')->where('id_perencanaan', $id_perencanaan)->update([
                        'status_perencana' => 3,
                        'keterangan' => $request->keterangan,
                        'file_balasan' => $imageN
                    ]);
            
                    return redirect('ketua/approvement')->with('status', 'Data Berhasil diProcess !');
                // Save Belum Pernah Ada [End]
                break;
        }
        
    }
    //Last Code
}
