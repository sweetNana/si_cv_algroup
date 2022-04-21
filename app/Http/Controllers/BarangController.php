<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BrgMasuk;
use App\Models\BrgKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function data()
    {
        $barangs = DB::table('tb_barang')->get();
        return view('staf/barang/data')->with('barangs', $barangs);
    }

    public function add()
    {
        $kode = Barang::kode(); 
        return view('staf/barang/add', ['kode' => $kode]);
    }

    public function addProcess(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'kategori' => 'required',
            'nama_barang' => 'required',
            // 'kondisi' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
        ], [
            'id_barang.required' => 'Id Barang Tidak Boleh Kosong !',
            'kategori.required' => 'Kategori Barang Tidak Boleh Kosong !',
            'nama_barang.required' => 'Nama Barang Tidak Boleh Kosong !',
            // 'kondisi.required' => 'Kondisi Barang Tidak Boleh Kosong !',
            'stok.required' => 'Stok Barang Tidak Boleh Kosong !',
            'keterangan.required' => 'Keterangan Tidak Boleh Kosong !',
        ]);

        DB::table('tb_barang')->insert([
                'id_barang' => $request->id_barang,
                'kategori' => $request->kategori,
                'nama_barang' => $request->nama_barang,
                // 'kondisi' => $request->kondisi,
                'stok' => $request->stok,
                'keterangan' => $request->keterangan
            ]);
        
        return redirect('staf/barang')->with('status', 'Data Berhasil diTambah !');
    }

    public function edit($id_barang)
    {
        $barangg = DB::table('tb_barang')->where('id_barang', $id_barang)->first();
        return view('staf/barang/edit', compact('barangg'));
    }

    public function editProcess(Request $request, $id_barang)
    {
        $request->validate([
            'id_barang' => 'required',
            'satuan' => 'required',
            'nama_barang' => 'required',
            // 'kondisi' => 'required',
            'stok' => 'required',
            // 'keterangan' => 'required',
        ], [
            'id_barang.required' => 'Kode Barang Harus di Isi !',
            'satuan.required' => 'Satuan Barang Harus di Isi !',
            'nama_barang.required' => 'Nama Barang Harus di Isi !',
            // 'kondisi.required' => 'Kondisi Barang Tidak Boleh Kosong !',
            'stok.required' => 'Stok Barang Harus di Isi !',
            // 'keterangan.required' => 'Keterangan Harus di Isi !',
        ]);

        DB::table('tb_barang')->where('id_barang', $id_barang)->update([
                'satuan' => $request->satuan,
                'nama_barang' => $request->nama_barang,
                // 'kondisi' => $request->kondisi,
                // 'keterangan' => $request->keterangan,
                'stok' => $request->stok
            ]);
        
        return redirect('staf/barang')->with('status', 'Data Berhasil diUbah !');
    }

    public function delete($id_barang)
    {
        DB::table('tb_barang')->where('id_barang', $id_barang)->delete();
        return redirect('staf/barang')->with('status', 'Data Berhasil diHapus !');
    }

    public function export()
    {
        $barangs = DB::table('tb_barang')->get();
        return view('staf/barang/export')->with('barangs', $barangs);
    }

    //Barang Masuk [Start]
    public function brgmasuk_data()
    {
        $brg_masuks = DB::table('tb_brg_masuk')
        ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.satuan')
        ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
        ->get();
        return view('staf/barang/brgmasuk_data')->with('brg_masuks', $brg_masuks);
    }

    public function addbrgmasuk_ada()
    {
        $kode = BrgMasuk::kode(); 
        // $kode_barangs = Barang::kode();
        $barangs = DB::table('tb_barang')->get();
        $suppliers = DB::table('tb_supplier')->get();
        return view('staf/barang/addbrgmasuk_ada', compact('barangs','suppliers','kode'));
    }

    public function addProcess_ada(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
        ], [
            'nama_barang.required' => 'Pilih Kode Barang Supaya Nama Barang terisi !',
            'jumlah.required' => 'Jumlah Harus di Isi !',
            'satuan.required' => 'Pilih Kode Barang Supaya Satuan terisi !',
        ]);

        DB::table('tb_brg_masuk')->insert([
            'id_brg_masuk' => $request->id_brg_masuk,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'supplier' => $request->supplier,
            'tgl_brg_masuk' => $request->tgl_brg_masuk,
            'satuan' => $request->satuan
        ]);

        DB::table('tb_barang')->where('id_barang', $request->id_barang)->increment('stok', $request->jumlah);
        
        return redirect('staf/barang/brgmasuk_data')->with('status', 'Data Berhasil diTambah !');
    }

    public function addbrgmasuk_tidak()
    {
        $kode = BrgMasuk::kode(); 
        $kode_barangs = Barang::kode();
        $barangs = DB::table('tb_barang')->get();
        $suppliers = DB::table('tb_supplier')->get();
        return view('staf/barang/addbrgmasuk_tidak', compact('barangs','suppliers','kode','kode_barangs'));
    }

    public function addProcess_tidak(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|unique:tb_brg_masuk,nama_barang', /* unique:Nama_DB, Nama_Field yang mau dicheck */
            'jumlah' => 'required',
            'satuan' => 'required',
        ], [
            'nama_barang.required' => 'Pilih Kode Barang Supaya Nama Barang terisi !',
            'jumlah.required' => 'Jumlah Harus di Isi !',
            'satuan.required' => 'Pilih Kode Barang Supaya Satuan terisi !',
            'nama_barang.unique' => 'Nama Barang Sudah Pernah Ada !',
        ]);

        DB::table('tb_brg_masuk')->insert([
            'id_brg_masuk' => $request->id_brg_masuk,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'supplier' => $request->supplier,
            'tgl_brg_masuk' => $request->tgl_brg_masuk,
            'satuan' => $request->satuan
        ]);

        DB::table('tb_barang')->insert([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->jumlah,
            'satuan' => $request->satuan
        ]);
    
        return redirect('staf/barang/brgmasuk_data')->with('status', 'Data Berhasil diTambah !');
    }
    //Barang Masuk [End]

    //Barang Keluar [Start]
    public function brgkeluar_data()
    {
        $brg_keluars = DB::table('tb_brg_keluar')->get();
        return view('staf/barang/brgkeluar_data')->with('brg_keluars', $brg_keluars);
    }

    public function addbrgkeluar()
    {
        $kode = BrgKeluar::kode(); 
        // $kode_barangs = Barang::kode();
        $barangs = DB::table('tb_barang')->get();
        $suppliers = DB::table('tb_supplier')->get();
        return view('staf/barang/addbrgkeluar', compact('barangs','suppliers','kode'));
    }
    
    public function addProcess_keluar(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required',
        ], [
            'nama_barang.required' => 'Pilih Kode Barang Supaya Nama Barang terisi !',
            'jumlah.required' => 'Jumlah Harus di Isi !',
        ]);

        DB::table('tb_brg_keluar')->insert([
            'id_brg_keluar' => $request->id_brg_keluar,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tgl_brg_keluar' => $request->tgl_brg_keluar
        ]);

        DB::table('tb_barang')->where('id_barang', $request->id_barang)->decrement('stok', $request->jumlah);
        
        return redirect('staf/barang/brgkeluar_data')->with('status', 'Data Berhasil diTambah !');
    }
    //Barang Keluar [End]

    //Laporan Barang Masuk [Start]
    public function laporan_brgmasuk_data()
    {
        $datecari = '';
        $brg_masuks = DB::table('tb_brg_masuk')
        ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.satuan')
        ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
        ->get();
        return view('staf/laporan/brgmasuk/data', compact('datecari','brg_masuks'));
    }

    public function brgmasuk_aksi(Request $request)
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
                    $brg_masuks = DB::table('tb_brg_masuk')
                    ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.satuan')
                    ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
                    ->whereDate('tgl_brg_masuk','>=', $from )
                    ->whereDate('tgl_brg_masuk','<=', $to)
                    ->get();
                    return view('staf/laporan/brgmasuk/data', compact('from','to','brg_masuks','datecari'));
                // Cari Data [End]
                break;

            case 'refresh':
                // Refresh Data [Start]
                    $datecari = '';
                    $brg_masuks = DB::table('tb_brg_masuk')
                    ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.satuan')
                    ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
                    ->get();
                    return view('staf/laporan/brgmasuk/data', compact('brg_masuks','datecari'));
                // Refresh Data [End]
                break;

            case 'convert':
                // Cetak Data [Start]
                if ($request->periode == "") {
                    $brg_masuks = DB::table('tb_brg_masuk')
                    ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.satuan')
                    ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
                    ->get();
                    return view('staf/laporan/brgmasuk/laporan', compact('brg_masuks'));
                    
                } else {
                    $from = Str::substr($request->periode, 0, 10);
                    $to = Str::substr($request->periode, 13);
                    $brg_masuks = DB::table('tb_brg_masuk')
                    ->select('tb_brg_masuk.id_brg_masuk', 'tb_brg_masuk.id_barang', 'tb_brg_masuk.nama_barang', 'tb_brg_masuk.jumlah', 'tb_supplier.nama_supplier','tb_brg_masuk.tgl_brg_masuk','tb_brg_masuk.satuan')
                    ->leftJoin('tb_supplier', 'tb_brg_masuk.supplier', '=', 'tb_supplier.id_supplier')
                    ->whereDate('tgl_brg_masuk','>=', $from)
                    ->whereDate('tgl_brg_masuk','<=', $to)
                    ->get();
                    return view('staf/laporan/brgmasuk/laporan', compact('brg_masuks'));
                }
                    
                // Cetak Data [End]
                break;
        }
    }
    //Laporan Barang Masuk [End]

    //Laporan Barang Keluar [Start]
    public function laporan_brgkeluar_data()
    {
        $datecari = '';
        $brg_keluars = DB::table('tb_brg_keluar')->get();
        return view('staf/laporan/brgkeluar/data', compact('datecari','brg_keluars'));
    }

    public function brgkeluar_aksi(Request $request)
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
                    $brg_keluars = DB::table('tb_brg_keluar')
                    ->whereDate('tgl_brg_keluar','>=', $from)
                    ->whereDate('tgl_brg_keluar','<=', $to)
                    ->get();
                    return view('staf/laporan/brgkeluar/data', compact('from','to','brg_keluars','datecari'));
                // Cari Data [End]
                break;

            case 'refresh':
                // Refresh Data [Start]
                    $datecari = '';
                    $brg_keluars = DB::table('tb_brg_keluar')
                    ->get();
                    return view('staf/laporan/brgkeluar/data', compact('brg_keluars','datecari'));
                // Refresh Data [End]
                break;

            case 'convert':
                // Cetak Data [Start]
                if ($request->periode == "") {
                    $brg_keluars = DB::table('tb_brg_keluar')
                    ->get();
                    return view('staf/laporan/brgkeluar/laporan', compact('brg_keluars'));
                    
                } else {
                    $from = Str::substr($request->periode, 0, 10);
                    $to = Str::substr($request->periode, 13);
                    $brg_keluars = DB::table('tb_brg_keluar')
                    ->whereDate('tgl_brg_keluar','>=', $from)
                    ->whereDate('tgl_brg_keluar','<=', $to)
                    ->get();
                    return view('staf/laporan/brgkeluar/laporan', compact('brg_keluars'));
                }
                    
                // Cetak Data [End]
                break;
        }
    }
    //Laporan Barang Keluar [End]

    //Ramalan WMA [Start]
    // public function wma($p_wma)
    public function wma(Request $request)
    {
        $p_wma = $request->barang_p;
        $wmas = DB::table('tb_perencanaan_brg')
            ->select(DB::raw('DATE_FORMAT(tb_perencanaan_brg.tgl_perencanaan,"%Y-%m") AS showdate, sum(jumlah_p) as jmlh, tb_perencanaan_brg.barang_p, tb_barang.nama_barang'))
            ->join('tb_barang', 'tb_perencanaan_brg.barang_p', '=', 'tb_barang.id_barang')
            ->where([['tb_perencanaan_brg.barang_p','=',$p_wma],['tb_perencanaan_brg.status_perencana','=', 2]])
            ->groupBy('tb_perencanaan_brg.barang_p', 'tb_barang.nama_barang','showdate')
            ->orderBy('showdate', 'asc')
            ->get();
        $namas = DB::table('tb_barang')
            ->where('id_barang', $p_wma)
            ->first();
        return view('staf/barang/wma', compact('wmas','namas'));
    }
    //Ramalan WMA [End]

    //History Barang di Perencanaan [Start]
    public function historybarang_p($id_barang)
    {
        $barangs = DB::table('tb_barang')->where('id_barang', $id_barang)->first();
        $data_historybarang_p = DB::table('tb_perencanaan_brg')
            ->join('tb_barang', 'tb_perencanaan_brg.barang_p', '=', 'tb_barang.id_barang')
            ->join('users', 'tb_perencanaan_brg.user_perencana', '=', 'users.id')
            ->where('barang_p','=',$id_barang)
            // ->where([['barang_p','=',$id_barang],['status_perencana','=', 2]])
            ->orderBy('tgl_perencanaan', 'asc')
            ->get();
        return view('staf/barang/historybarang_p', compact('data_historybarang_p','barangs'));
    }
    //History Barang di Perencanaan [End]

    //Last Code
}
