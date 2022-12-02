<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class hasilController extends Controller
{
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
        	$id = $key -> id_pegawai;
        }

        $hasil = DB::table('hasil')->where('id_pegawai', $id)->get();
        $html = '';
        foreach ($hasil as $key) {
        	 
        	$data = $key -> skor;
        	$data2 = $key -> target;
        	if ($data >= $data2) {
        		$html = '<div class="w3-panel w3-green"><p>Anda diperkenankan untuk naik jabatan !</p></div>'; 
        	}else{
        		$html = '<div class="w3-panel w3-red"><p>Anda belum diperkenankan untuk naik jabatan !</p></div>';
        	}
        }
        return view('hasil_plan.index', ['hasil' => $hasil, 'html' => $html]);

    }

    public function detail($id){
    	$hasil = DB::table('hasil')->where('id', $id)->first();
        $detail = DB::table('hasil_detail as a')
                ->join('pertanyaan as b', 'b.id_pertanyaan','=','a.pertanyaan_id')
                ->where('hasil_id', $hasil->id)
                ->get();
                // dd($detail);
        $jabfung = DB::table('jabfung')->where('angka_kredit',$hasil->target)->pluck('nama_jabfung')->first();
      
    	return view('hasil_plan.detail', ['hasil' => $hasil, 'detail'=> $detail,'jabfung' => $jabfung]);
    }

    public function delete($id){
    	DB::table('hasil')->where('id', $id)->delete();

    	return redirect('/hasil_plan');
    }
}
