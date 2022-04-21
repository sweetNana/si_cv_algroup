<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pengajuan extends Model
{
    use HasFactory;

    public static function kode()
    {
    	$kode = DB::table('tb_pengajuan_brg')->where('id_pengajuan', 'like', 'PJU'.'%')->max('id_pengajuan');
    	$addNol = '';
    	$kode = str_replace("PJU", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "000";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 3) {
    		$addNol = "0";
    	}

    	$kodeBaru = "PJU".$addNol.$incrementKode;
    	return $kodeBaru;
    }

	public static function kode_staf()
    {
    	$kode = DB::table('tb_pengajuan_brg')->where('id_pengajuan', 'like', 'PJS'.'%')->max('id_pengajuan');
    	$addNol = '';
    	$kode = str_replace("PJS", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "000";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 3) {
    		$addNol = "0";
    	}

    	$kodeBaru = "PJS".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
