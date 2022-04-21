<?php

namespace App\Http\Controllers;

use App\Models\BrgKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrgKeluarController extends Controller
{
    public function data()
    {
        $brg_keluars = DB::table('tb_brg_keluar')->get();
        return view('staf/brg_keluar/data')->with('brg_keluars', $brg_keluars);
    }

    public function add()
    {
        $kode = BrgKeluar::kode(); 
        $barangs = DB::table('tb_barang')->where('stok', '>' , 0)->get();
        return view('staf/brg_keluar/add', compact('kode','barangs'));
    }

    public function addProcess(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required',
        ], [
            'nama_barang.required' => 'Pilih Id_Barang Terlebih Dahulu !',
            'jumlah.required' => 'Jumlah Tidak Boleh Kosong !',
        ]);

        DB::table('tb_brg_keluar')->insert([
            'id_brg_keluar' => $request->id_brg_keluar,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'tgl_brg_keluar' => $request->tgl_brg_keluar,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah
        ]);

        //Pengurangan data barang
        DB::table('tb_barang')->where('id_barang', $request->id_barang)->decrement('stok', $request->jumlah);
         
        return redirect('staf/brg_keluar')->with('status', 'Data Berhasil diTambah !');
    }

    public function delete($id_brg_keluar)
    {
        DB::table('tb_brg_keluar')->where('id_brg_keluar', $id_brg_keluar)->delete();
        return redirect('staf/brg_keluar')->with('status', 'Data Berhasil diHapus !');
    }

    public function export()
    {
        $brg_keluars = DB::table('tb_brg_keluar')->get();
        return view('staf/brg_keluar/export')->with('brg_keluars', $brg_keluars);
    }
    //Last Code
}
