<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\modelPendidikan;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = DB::table('jenjang_pendidikan as a')
                        ->join('pegawai as b', 'a.id_jenjang_pendidikan', '=', 'b.tkt_ijazah')
                        ->join('dosen as c', 'b.id_pegawai', '=', 'c.id_pegawai')
                        ->join('pangkat_golongan as d', 'b.id_pangkat_golongan', '=', 'd.id_pangkat_golongan')
                        ->join('jabfung as e', 'b.jabatan', '=', 'e.id_jabfung')
                        ->where(function($q){
                            $id = Auth::user()->username;
                            $q->where('b.nip', $id)
                            ->orWhere('c.nidn', $id);
                        })
                        ->get(); 
        foreach ($data as $key) {
            $jabfung_semen = DB::table('jabfung_sementara as a')
                            ->join('jabfung as b', 'a.id_jabfung', '=', 'b.id_jabfung')
                            ->where('a.id_pegawai', $key -> id_pegawai)->get();
                           
        }
          if (count($jabfung_semen) > 0) {
            foreach ($jabfung_semen as $key) {
                $html = "<div class='col-xs-2'>
                        <div class='stat-box colornine'>
                        <i class='author'>&nbsp;</i>
                        <h4>Jabatan Fungsional Sementara</h4>
                        <h4>".$key->nama_jabfung."</h4>
                        </div>
                        </div>";
            }  
              return view('home', ['data' => $data, 'jabfung_semen' => $html]);
            }else{
              return view('home', ['data' => $data]);
            }
       
        
            
    }
}
