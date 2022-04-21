<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Barang;
use App\Models\BrgMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrgMasukController extends Controller
{
    public function data()
    {
        $brg_masuks = DB::table('tb_brg_masuk')
            ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.kategori')
            ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
            ->get();
        return view('staf/brg_masuk/data')->with('brg_masuks', $brg_masuks);
    }

    public function add()
    {
        $kode = BrgMasuk::kode(); 
        $kode_barangs = Barang::kode(); 
        $barangs = DB::table('tb_barang')->get();
        $suppliers = DB::table('tb_supplier')->get();
        return view('staf/brg_masuk/add', compact('kode','barangs','suppliers','kode_barangs'));
    }

    public function add_supplier()
    {
        $kode = Supplier::kode(); 
        return view('staf/supplier/add', compact('kode'));
    }

    public function addProcess(Request $request)
    {
        switch ($request->input('action')) {
            case 'save_a':
                // Save Udah Pernah Ada [Start]
                    $request->validate([
                        'nama_barang' => 'required',
                        'jumlah' => 'required',
                        'kategori' => 'required',
                    ], [
                        'nama_barang.required' => 'Nama Barang Tidak Boleh Kosong !',
                        'jumlah.required' => 'Jumlah Tidak Boleh Kosong !',
                        'kategori.required' => 'Kategori Tidak Boleh Kosong !',
                    ]);
            
                    DB::table('tb_brg_masuk')->insert([
                        'id_brg_masuk' => $request->id_brg_masuk,
                        'id_barang' => $request->id_barang,
                        'nama_barang' => $request->nama_barang,
                        'jumlah' => $request->jumlah,
                        'supplier' => $request->supplier,
                        'tgl_brg_masuk' => $request->tgl_brg_masuk,
                        'kategori' => $request->kategori
                    ]);
            
                    DB::table('tb_barang')->where('id_barang', $request->id_barang)->increment('stok', $request->jumlah);
                    
                    return redirect('staf/brg_masuk')->with('status', 'Data Berhasil diTambah !');
                // Save Udah Pernah Ada [End]
                break;

            case 'save_b':
                // Save Belum Pernah Ada [Start]
                    $request->validate([
                        'nama_barang2' => 'required',
                        'jumlah2' => 'required',
                        'kategori2' => 'required',
                    ], [
                        'nama_barang2.required' => 'Nama Barang Tidak Boleh Kosong !',
                        'jumlah2.required' => 'Jumlah Tidak Boleh Kosong !',
                        'kategori2.required' => 'Kategori Tidak Boleh Kosong !',
                    ]);
            
                    DB::table('tb_brg_masuk')->insert([
                        'id_brg_masuk' => $request->id_brg_masuk2,
                        'id_barang' => $request->id_barang2,
                        'nama_barang' => $request->nama_barang2,
                        'jumlah' => $request->jumlah2,
                        'supplier' => $request->supplier2,
                        'tgl_brg_masuk' => $request->tgl_brg_masuk2,
                        'kategori' => $request->kategori2
                    ]);
            
                    DB::table('tb_barang')->insert([
                        'id_barang' => $request->id_barang2,
                        'nama_barang' => $request->nama_barang2,
                        'stok' => $request->jumlah2,
                        'kategori' => $request->kategori2
                    ]);
                    
                    return redirect('staf/brg_masuk')->with('status', 'Data Berhasil diTambah !');
                // Save Belum Pernah Ada [End]
                break;

            case 'advanced_edit':
                // Redirect to advanced edit
                break;
        }
    }

    public function export()
    {
        $brg_masuks = DB::table('tb_brg_masuk')
            ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.kategori')
            ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
            ->get();
        return view('staf/brg_masuk/export')->with('brg_masuks', $brg_masuks);
    }
    //Lat Code
}
