<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\fungsiGlobal;
use App\User;
use Hash;

class Profil extends Controller
{
    public function updateProfil(Request $data) {
    	if(!fungsiGlobal::decrypt($data->jabatan) || !fungsiGlobal::decrypt($data->lastPend)) return "problem";
    	try {
        	$email    = $data->email;
            $tglLahir = $data->tglLahir;
        	$jabatan  = fungsiGlobal::decrypt($data->jabatan);
        	$pend     = fungsiGlobal::decrypt($data->lastPend);
        	$tglJadi  = $data->tglJadi;
            $serdos   = $data->serdos;

            $update   = User::where("id",Auth::user()->id)->update([
                "email" => $email,
                "tglLahir" => $tglLahir,
                "id_jab"   => $jabatan,
                "id_pend"  => $pend,
                "tglJadi"  => $tglJadi,
                "serdos"   => $serdos
            ]);
            if($update) return "success"; else return "problem";
        } catch (Exception $err) {
    		return "problem";
    	};
    }

    public function updateSandi(Request $data) {
        $sandi      = $data->sandi;
        $sandiBaru  = $data->sandiBaru;
        $konfSandi  = $data->konfSandi;
        if (hash::check($sandi,auth::user()->password)) {
            $update = User::where("id",Auth::user()->id)->update([
                "password" => bcrypt($sandiBaru)
            ]);
            if ($update) return "success"; else return "problem";
        } else return "notMatch";
    }
}
