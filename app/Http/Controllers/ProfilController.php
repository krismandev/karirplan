<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelJabatan;
use App\modelPendidikan;

class ProfilController extends Controller
{
    public function index() {
    	$jabatan    = modelJabatan::where("golongan","!=","IV/e")->get();
        $pendidikan = modelPendidikan::all();
    	return view("akun.index")
    		->with("jabatan",$jabatan)
    		->with("pendidikan",$pendidikan);
    }

    public function gantiSandi() {
    	return view("akun.gantiSandi");
    }
}
