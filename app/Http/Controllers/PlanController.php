<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelPertanyaan;
use App\modelPertanyaanDropdown;
use App\modelUnsur;
use App\modelSubUnsur;
use Illuminate\Support\Facades\DB;
use Auth;
class PlanController extends Controller
{

    public function index() {
        return "Belum dibuat!";
    }

    public function input() {
        $data = DB::table('jenjang_pendidikan as a')
                        ->join('pegawai as b', 'a.id_jenjang_pendidikan', '=', 'b.tkt_ijazah')
                        ->join('dosen as c', 'b.id_pegawai', '=', 'c.id_pegawai')
                        ->join('pangkat_golongan as d', 'b.id_pangkat_golongan', '=', 'd.id_pangkat_golongan')
                        ->join('jabfung as e', 'b.jabatan', '=', 'e.id_jabfung')
                        ->where(function($q){
                            $id = Auth::user()->username;
                            $q->where('b.nip', $id)
                            ->orWhere('c.nidn', $id);
                        })->get(); 
                        
        $jabfung = DB::table('jabfung')->get();
        
        $listUnsur = modelUnsur::orderby('kode_unsur')->get();

        $listSubUnsur = modelSubUnsur::get();
        
        $listPertanyaan = modelPertanyaan::get();

        $listPertanyaanDropdown = modelPertanyaanDropdown::get();

        return view("plan.input")
                ->with("jabfung", $jabfung)->with("data", $data)
                /*Pengabdian*/
                ->with("listUnsur", $listUnsur) 
                ->with("listSubUnsur", $listSubUnsur) 
                ->with("listPertanyaan", $listPertanyaan)
                ->with("listPertanyaanDropdown", $listPertanyaanDropdown);
        
    }

    public function hitungUnsurPendidikan($request,$list_pertanyaan_existing)
    {
        

        $data = [];
        foreach ($request->all() as $key => $value) {
            $list_pertanyaan = $list_pertanyaan_existing;
            $checkIsUnsurA = explode("-",$key)[0] == "A" ? true : false;
            
            try {
                if ($checkIsUnsurA == true) {
                    $pertanyaan = $list_pertanyaan->where("kode",$key)->first();

                    switch ($key) {
                        //case spesial. contohnya seperti A-II-A yg nilai ny bergantung pada jabfung. sambil bikin ini, perhatiin panduan ny jg
                        // karna ada beberpa pertanyaan yg kondisiny tidak seragam/ unik seperti ini.
                        case 'A-II-A':
                            if($request->plan_jabfung = "Asisten Ahli"){
                                if ($value >= 12) {
                                    $kredit = 5.5;
                                }elseif ($value >= 10 && $value < 12) {
                                    $kredit = 5.0;
                                }else{
                                    $kredit = $value * 0.5;
                                }
                                $push = [
                                    "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                    "jawaban"=>$value,
                                    "nilai"=>$kredit
                                ];
                                array_push($data,$push);
                            }else{
                                if ($value >= 12) {
                                    $kredit = 11;
                                }elseif ($value >= 10 && $value < 12) {
                                    $kredit = 11;
                                }else{
                                    $kredit = $value * 1;
                                }
    
                                $push = [
                                    "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                    "jawaban"=>$value,
                                    "nilai"=>$kredit
                                ];
                                array_push($data,$push);
                            }
                            break;
                        case 'value':
                            // 
                            break;
                        default:
                            //default ini untuk pertanyaan yg tidak ada kondisi khusus seperti A-II-A 
                            
                            // kalau jenis nya 1 (Ya / Tidak)
                            if ($pertanyaan->jenis == 1) {
                                //kalau jewabannya Tidak
                                if ($value == 0) {
                                    $kredit = 0;
                                }else{
                                    //kalau jawabannya Ya. kredit = kredit yg disimpan ditable pertanyaan
                                    $kredit = $pertanyaan->kredit;
                                }
                            } elseif ($pertanyaan->jenis == 2) {
                                if ($value > $pertanyaan->batas) {
                                    $kredit = $pertanyaan->batas * $pertanyaan->kredit;
                                }else{
                                    $kredit = $value * $pertanyaan->kredit;
                                }                            
                            }elseif ($pertanyaan->jenis == 3) {
                                $kredit = $value;
                            }
    
    
                            $push = [
                                "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                "jawaban"=>$value,
                                "nilai"=>$kredit
                            ];
    
                            array_push($data,$push);
                            break;
                    }
                }
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }

        return $data;
    }

    public function hitungUnsurPengabdian($request,$list_pertanyaan_existing)
    {

        $data = [];
        foreach ($request->all() as $key => $value) {
            $list_pertanyaan = $list_pertanyaan_existing;
            $checkIsUnsurC = explode("-",$key)[0] == "C" ? true : false;
            try {
                if ($checkIsUnsurC == true) {
                    $pertanyaan = $list_pertanyaan->where("kode",$key)->first();

                    switch ($key) {
                        //case spesial. contohnya seperti A-II-A yg nilai ny bergantung pada jabfung. sambil bikin ini, perhatiin panduan ny jg
                        // karna ada beberpa pertanyaan yg kondisiny tidak seragam/ unik seperti ini.
                        
                        case 'value':
                            // 
                            break;
                        default:
                            //default ini untuk pertanyaan yg tidak ada kondisi khusus seperti A-II-A 
                            
                            // kalau jenis nya 1 (Ya / Tidak)
                            if ($pertanyaan->jenis == 1) {
                                //kalau jewabannya Tidak
                                if ($value == 0) {
                                    $kredit = 0;
                                }else{
                                    //kalau jawabannya Ya. kredit = kredit yg disimpan ditable pertanyaan
                                    $kredit = $pertanyaan->kredit;
                                }
                            } elseif ($pertanyaan->jenis == 2) {
                                if ($pertanyaan->batas != null && $value > $pertanyaan->batas) {
                                    $kredit = $pertanyaan->batas * $pertanyaan->kredit;
                                }else{
                                    $kredit = $value * $pertanyaan->kredit;
                                }                            
                            }elseif ($pertanyaan->jenis == 3) {
                                $kredit = $value;
                            }
    
    
                            $push = [
                                "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                "jawaban"=>$value,
                                "nilai"=>$kredit
                            ];
    
                            array_push($data,$push);
                            break;
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        return $data;
    }

    public function store( Request $request){
        // dd($request->all());
        //jabfung tujuan. nilai ny angka kredit tujuan
        $jabfung = $request->plan_jabfung;

        $list_pertanyaan_existing = modelPertanyaan::all();
        $list_data_unsur_pendidikan = $this->hitungUnsurPendidikan($request,$list_pertanyaan_existing);
        $list_data_unsur_pengabdian = $this->hitungUnsurPengabdian($request,$list_pertanyaan_existing);
        // dd($list_data_unsur_pendidikan);


        $sum_unsur_pendidikan = 0.0;
        foreach ($list_data_unsur_pendidikan as $item) {
            $sum_unsur_pendidikan += $item["nilai"];
        }

        $sum_unsur_pengabdian = 0.0;
        foreach ($list_data_unsur_pengabdian as $item) {
            $sum_unsur_pengabdian += $item["nilai"];
        }


        // dd($sum_unsur_pendidikan);

        dd($this->persentase_jabfung_pendidikan($jabfung, $sum_unsur_pendidikan));   
        // dd($this->persentase_jabfung_pengabdian($jabfung,$sum_unsur_pengabdian));

        

    //    $data_persentase_pembelajaran = persentase_jabfung_pendidikan($jabfung, $data_pembelajaran);

    //PENELITIAN
        $sum_unsur_penelitian= 0.0;
        foreach($list_data_unsur_penelitian as $item){
            $sum_unsur_penelitian += $item["nilai"];
        }
    // dd($this->persentase_jabfung_penelitian($jabfung, $sum_unsur_penelitian));  
    //    $data_persentase_penelitiann = persentase_jabfung_penelitian($jabfung, $data_penelitian);
       

    //    $data_persentase_pengabdian = persentase_jabfung_pengabdian($jabfung, $data_pengabdian);
       
     


    //    $data_persentase_penunjang = persentase_jabfung_penunjang($jabfung, $data_penunjang);

        // $hasil = data_yes_no($data1, 200) + 
        //          data_yes_no($data2, 150) + 
        //          data_yes_no($data3, 3) +
        //          $data_persentase_pembelajaran+
        //          $data_persentase_penelitiann+
        //          $data_persentase_pengabdian+
        //          $data_persentase_penunjang;
        //$data_persentase_pembelajaran;

                 $semester = $request -> semester;
                 $nip = $request -> nip_pegawai;

                //  DB::table('hasil')->insert(
                // ['id_pegawai' => $nip, 'semester' => $semester, 'skor' => $hasil, 'target' => $jabfung]
                // );
           return redirect('/hasil_plan');
    }

    function persentase_jabfung_pendidikan($jabfung, $data){
        if($jabfung == 100 or $jabfung == 150){
            $minimal = $jabfung * 0.55;
            $hasil = $data;
        }elseif($jabfung == 200 or $jabfung == 300){
            $minimal = $jabfung * 0.45;
            $hasil = $data;
        }elseif($jabfung == 400 or $jabfung == 550 or $jabfung == 700){
            $minimal = $jabfung * 0.40;
            $hasil = $data;
        }elseif($jabfung == 850 or $jabfung == 1050){
            $minimal = $jabfung * 0.35;
            $hasil = $data;
        }else{
            $hasil = 0;
        }

        dd($minimal);

        if ($hasil > $minimal) {
            $mencapaiMinimum = true;
        }else {
            $mencapaiMinimum = false;
        }

        $data = [
            "hasil"=>$hasil,
            "mencapaiMinimum"=>$mencapaiMinimum
        ];
        return $data;
    }

    function persentase_jabfung_penelitian($jabfung, $data){
        if($jabfung == 100 or $jabfung == 150){
            $hasil = $data * 0.25;
        }elseif($jabfung == 200 or $jabfung == 300){
            $hasil = $data * 0.35;
        }elseif($jabfung == 400 or $jabfung == 550 or $jabfung == 700){
            $hasil = $data * 0.40;
        }elseif($jabfung == 850 or $jabfung == 1050){
            $hasil = $data * 0.45;
        }else{
            $hasil = 0;
        }
        return $hasil;
    }

    function persentase_jabfung_pengabdian($jabfung, $data){
        $hasil = $data * 0.10;

        return $hasil;
    }

    function persentase_jabfung_penunjang($jabfung, $data){
        $hasil = $data * 0.10;
        
        return $hasil;
    }
}
