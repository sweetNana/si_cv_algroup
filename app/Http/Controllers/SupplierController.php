<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function data()
    {
        $suppliers = DB::table('tb_supplier')->get();
        return view('staf/supplier/data')->with('suppliers', $suppliers);
    }

    public function add()
    {
        $kode = Supplier::kode(); 
        return view('staf/supplier/add', ['kode' => $kode]);
    }

    public function addProcess(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
            'nama_supplier' => 'required|unique:tb_supplier,nama_supplier',
            'alamat_supplier' => 'required',
            'telepon_supplier' => 'required',
        ], [
            'id_supplier.required' => 'Id Supplier Harus di Isi !',
            'nama_supplier.required' => 'Nama Supplier Harus di Isi !',
            'nama_supplier.unique' => 'Nama Supplier Sudah Pernah Ada !',
            'alamat_supplier.required' => 'Alamat Harus di Isi !',
            'telepon_supplier.required' => 'No Telepon Harus di Isi !',
        ]);

        DB::table('tb_supplier')->insert([
                'id_supplier' => $request->id_supplier,
                'nama_supplier' => $request->nama_supplier,
                'alamat_supplier' => $request->alamat_supplier,
                'telepon_supplier' => $request->telepon_supplier
            ]);
        
        return redirect('staf/supplier')->with('status', 'Data Berhasil diTambah !');
    }

    public function edit($id_supplier)
    {
        $supplierr = DB::table('tb_supplier')->where('id_supplier', $id_supplier)->first();
        return view('staf/supplier/edit', compact('supplierr'));
    }

    public function editProcess(Request $request, $id_supplier)
    {
        $nama_suppliers = DB::table('tb_supplier')->select('nama_supplier')->where('id_supplier', $id_supplier)->first();
        if($request->nama_supplier == $request->nama_supplier2){
            $request->validate([
                'id_supplier' => 'required',
                'nama_supplier' => 'required',
                'alamat_supplier' => 'required',
                'telepon_supplier' => 'required',
            ], [
                'id_supplier.required' => 'Id Supplier Harus di Isi !',
                'nama_supplier.required' => 'Nama Supplier Harus di Isi !',
                'alamat_supplier.required' => 'Alamat Harus di Isi !',
                'telepon_supplier.required' => 'No Telepon Harus di Isi !',
            ]);
        }else{
            $request->validate([
                'id_supplier' => 'required',
                'nama_supplier' => 'required|unique:tb_supplier,nama_supplier',
                'alamat_supplier' => 'required',
                'telepon_supplier' => 'required',
            ], [
                'id_supplier.required' => 'Id Supplier Harus di Isi !',
                'nama_supplier.required' => 'Nama Supplier Harus di Isi !',
                'nama_supplier.unique' => 'Nama Supplier Sudah Pernah Ada !',
                'alamat_supplier.required' => 'Alamat Harus di Isi !',
                'telepon_supplier.required' => 'No Telepon Harus di Isi !',
            ]);
        }

        DB::table('tb_supplier')->where('id_supplier', $id_supplier)->update([
                'nama_supplier' => $request->nama_supplier,
                'alamat_supplier' => $request->alamat_supplier,
                'telepon_supplier' => $request->telepon_supplier
            ]);
        
        return redirect('staf/supplier')->with('status', 'Data Berhasil diUbah !');
    }

    public function delete($id_supplier)
    {
        DB::table('tb_supplier')->where('id_supplier', $id_supplier)->delete();
        return redirect('staf/supplier')->with('status', 'Data Berhasil diHapus !');
    }

    public function export()
    {
        $suppliers = DB::table('tb_supplier')->get();
        return view('staf/supplier/export')->with('suppliers', $suppliers);
    }
// Last Code
}
