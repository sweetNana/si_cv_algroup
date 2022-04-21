<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\StafChatController;
use App\Http\Controllers\BrgMasukController;
use App\Http\Controllers\BrgKeluarController;
use App\Http\Controllers\ApprovementController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'halamanlogin'])->name('login');
Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware'=>'auth','cekrole:superadmin,staf,ketua'], function(){

    //Staf Home
    Route::get('/home', [HomeController::class, 'data'])->name('home');

    //Staf Supplier
    Route::get('/staf/supplier', [SupplierController::class, 'data']);
    Route::get('/staf/supplier/add', [SupplierController::class, 'add']);
    Route::post('/staf/supplier/addProcess', [SupplierController::class, 'addProcess']);
    Route::get('/staf/supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::patch('/staf/supplier/editProcess/{id}', [SupplierController::class, 'editProcess']);
    Route::delete('staf/supplier/delete/{id}', [SupplierController::class, 'delete']);
    Route::get('/staf/supplier/export', [SupplierController::class, 'export']);

    //Staf Barang
    Route::get('/staf/barang', [BarangController::class, 'data']);
    Route::get('/staf/barang/add', [BarangController::class, 'add']);
    Route::post('/staf/barang/addProcess', [BarangController::class, 'addProcess']);
    Route::get('/staf/barang/edit/{id}', [BarangController::class, 'edit']);
    Route::patch('/staf/barang/editProcess/{id}', [BarangController::class, 'editProcess']);
    Route::delete('staf/barang/delete/{id}', [BarangController::class, 'delete']);
    Route::get('/staf/barang/export', [BarangController::class, 'export']);
    Route::get('/staf/barang/historybarang_p/{id}', [BarangController::class, 'historybarang_p']);

    //Staf WMA
    // Route::get('/staf/barang/wma/{p_wma}', [BarangController::class, 'wma']);
    Route::post('/staf/barang/wma', [BarangController::class, 'wma']);

    // Barang Masuk
    Route::get('/staf/barang/brgmasuk_data', [BarangController::class, 'brgmasuk_data']);
    Route::get('/staf/barang/addbrgmasuk_ada', [BarangController::class, 'addbrgmasuk_ada']);
    Route::post('/staf/barang/addProcess_ada', [BarangController::class, 'addProcess_ada']);
    Route::get('/staf/barang/addbrgmasuk_tidak', [BarangController::class, 'addbrgmasuk_tidak']);
    Route::post('/staf/barang/addProcess_tidak', [BarangController::class, 'addProcess_tidak']);

    // Barang Keluar
    Route::get('/staf/barang/brgkeluar_data', [BarangController::class, 'brgkeluar_data']);
    Route::get('/staf/barang/addbrgkeluar', [BarangController::class, 'addbrgkeluar']);
    Route::post('/staf/barang/addProcess_keluar', [BarangController::class, 'addProcess_keluar']);

    //Staf User
    Route::get('/staf/user', [UserController::class, 'data']);
    Route::get('/staf/user/add', [UserController::class, 'add']);
    Route::post('/staf/user/addProcess', [UserController::class, 'addProcess']);
    Route::delete('staf/user/delete/{id}', [UserController::class, 'delete']);

    //Staf Pengajuan
    // Route::get('/staf/staf_pengajuan/{role}', [PengajuanController::class, 'staf_data']);
    // Route::get('/staf/staf_pengajuan/staf_cek_file/{id}', [PengajuanController::class, 'staf_cek_file']);
    // Route::get('/staf/staf_pengajuan/cek_data/{role}/{id}', [PengajuanController::class, 'cek_data']);
    // Route::post('/staf/staf_pengajuan/staf_addProcess/{role}/{id}', [PengajuanController::class, 'staf_addProcess']);
    // Route::get('/staf/staf_pengajuan/approval/{id}', [PengajuanController::class, 'approval']);
    // Route::get('/staf/staf_pengajuan/staf_cek_file_balasan/{id}', [PengajuanController::class, 'staf_cek_file_balasan']);
    // Route::get('/staf/staf_pengajuan/export/{role}', [PengajuanController::class, 'export']);

    //Staf Perencanaan
    Route::get('/staf/perencanaan', [PerencanaanController::class, 'data']);
    Route::get('/staf/perencanaan/add', [PerencanaanController::class, 'add']);
    Route::post('/staf/perencanaan/addProcess', [PerencanaanController::class, 'addProcess']);
    Route::get('/staf/perencanaan/cek_file/{id}', [PerencanaanController::class, 'cek_file']);
    Route::get('/staf/perencanaan/cek_file_balasan/{id}', [PerencanaanController::class, 'cek_file_balasan']);
    Route::get('/staf/perencanaan/cek_brg/{id}', [PerencanaanController::class, 'cek_brg']);
    Route::post('/staf/perencanaan/addProcessAjukan', [PerencanaanController::class, 'addProcessAjukan']);
    Route::get('/staf/perencanaan/export', [PerencanaanController::class, 'export']);
    Route::delete('/staf/perencanaan/delete/{id}/{file}', [PerencanaanController::class, 'delete']);

    //Staf Chat
    Route::get('/staf/chat', [StafChatController::class, 'data']);
    Route::get('/staf/chat/chat/{id_from}/{id_to}', [StafChatController::class, 'chat']);
    Route::post('/staf/chat/addChat/{id_to}/{id_from}', [StafChatController::class, 'addChat']);

    //Staf Laporan Barang Masuk
    Route::get('/staf/laporan/brgmasuk/data', [BarangController::class, 'laporan_brgmasuk_data']);
    Route::post('/staf/laporan/brgmasuk/brgmasuk_aksi', [BarangController::class, 'brgmasuk_aksi']);

    //Staf Laporan Barang Keluar
    Route::get('/staf/laporan/brgkeluar/data', [BarangController::class, 'laporan_brgkeluar_data']);
    Route::post('/staf/laporan/brgkeluar/brgkeluar_aksi', [BarangController::class, 'brgkeluar_aksi']);

    //Staf Laporan Perencanaan
    Route::get('/staf/laporan/perencanaan/data', [PerencanaanController::class, 'data_laporan']);
    Route::post('/staf/laporan/perencanaan/perencanaan_aksi', [PerencanaanController::class, 'perencanaan_aksi']);
    Route::get('/staf/laporan/perencanaan/cek_file_laporan/{id}', [PerencanaanController::class, 'cek_file_laporan']);

    //Staf Barang Masuk
    // Route::get('/staf/brg_masuk', [BrgMasukController::class, 'data']);
    // Route::get('/staf/brg_masuk/add', [BrgMasukController::class, 'add']);
    // Route::get('/staf/brg_masuk/add_supplier', [BrgMasukController::class, 'add_supplier']);
    // Route::post('/staf/brg_masuk/addProcess', [BrgMasukController::class, 'addProcess']);
    // Route::get('/staf/brg_masuk/export', [BrgMasukController::class, 'export']);

    //Staf Barang Keluar
    // Route::get('/staf/brg_keluar', [BrgKeluarController::class, 'data']);
    // Route::get('/staf/brg_keluar/add', [BrgKeluarController::class, 'add']);
    // Route::post('/staf/brg_keluar/addProcess', [BrgKeluarController::class, 'addProcess']);
    // Route::delete('staf/brg_keluar/delete/{id}', [BrgKeluarController::class, 'delete']);
    // Route::get('/staf/brg_keluar/export', [BrgKeluarController::class, 'export']);

    //Staf History
    Route::get('/staf/history', [HistoryController::class, 'data']);

    //User Pengajuan
    // Route::get('/user/pengajuan', [PengajuanController::class, 'data']);
    // Route::get('/user/pengajuan/cek_file/{id}', [PengajuanController::class, 'cek_file']);
    // Route::get('/user/pengajuan/add', [PengajuanController::class, 'add']);
    // Route::post('/user/pengajuan/addProcess', [PengajuanController::class, 'addProcess']);
    // Route::get('/user/pengajuan/cek_barang/{id}', [PengajuanController::class, 'cek_barang']);

    //Ketua Approvement
    Route::get('/ketua/approvement', [ApprovementController::class, 'data']);
    Route::get('/ketua/approvement/approval/{id}', [ApprovementController::class, 'approval']);
    Route::get('/ketua/approvement/process/{pilihan}/{id}', [ApprovementController::class, 'process']);
    Route::post('/ketua/approvement/addProcess/{id}', [ApprovementController::class, 'addProcess']);

});