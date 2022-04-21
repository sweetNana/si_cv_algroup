<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Supplier extends Model
{
    use HasFactory;

    public static function kode()
    {
    	$kode = DB::table('tb_supplier')->max('id_supplier');
    	$addNol = '';
    	$kode = str_replace("SPR-", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
    	// } elseif (strlen($kode) == 3) {
    	// 	$addNol = "0";
    	}

    	$kodeBaru = "SPR-".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
