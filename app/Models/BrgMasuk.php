<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BrgMasuk extends Model
{
	protected $table = "tb_brg_masuk";
    protected $fillable = ['id_brg_masuk','id_barang','nama_barang','jumlah','supplier','tgl_brg_masuk'];

    use HasFactory;
    public static function kode()
    {
    	$kode = DB::table('tb_brg_masuk')->max('id_brg_masuk');
    	$addNol = '';
    	$kode = str_replace("BRG-M-", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
    	// } elseif (strlen($kode) == 3) {
    	// 	$addNol = "0";
    	}

    	$kodeBaru = "BRG-M-".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
