<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\modelPertanyaan;
use App\modelPertanyaanDropdown;
use App\modelUnsur;
use App\modelSubUnsur;
use App\Hasil;
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

    public function hitungUnsurPenelitian($request,$list_pertanyaan_existing)
    {

        $data = [];
        foreach ($request->all() as $key => $value) {
            $list_pertanyaan = $list_pertanyaan_existing;
            $checkIsUnsurB = explode("-",$key)[0] == "B" ? true : false;
            try {
                if ($checkIsUnsurB == true) {
                    $pertanyaan = $list_pertanyaan->where("kode",$key)->first();
                    // dd($pertanyaan);

                    switch ($key) {
                        
                        case 'value':
                            break;
                        default:
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
                        
                        case 'value':
                            // 
                            break;
                        default:
                            
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

    public function hitungUnsurPenunjang($request,$list_pertanyaan_existing)
    {

        $data = [];
        foreach ($request->all() as $key => $value) {
            $list_pertanyaan = $list_pertanyaan_existing;
            $checkIsUnsurD = explode("-",$key)[0] == "D" ? true : false;
            try {
                if ($checkIsUnsurD == true) {
                    $pertanyaan = $list_pertanyaan->where("kode",$key)->first();

                    switch ($key) {
                        
                        case 'value':
                            // 
                            break;
                        default:
                            
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
                $e->getMessage();
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
        $list_data_unsur_penelitian = $this->hitungUnsurPenelitian($request,$list_pertanyaan_existing);
        $list_data_unsur_pengabdian = $this->hitungUnsurPengabdian($request,$list_pertanyaan_existing);
        $list_data_unsur_penunjang = $this->hitungUnsurPenunjang($request,$list_pertanyaan_existing);
     
        $sum_unsur_pendidikan = 0.0;
        foreach ($list_data_unsur_pendidikan as $item) {
            $sum_unsur_pendidikan += $item["nilai"];
        }

        $sum_unsur_penelitian= 0.0;
        foreach($list_data_unsur_penelitian as $item){
            $sum_unsur_penelitian += $item["nilai"];
        }

        $sum_unsur_pengabdian = 0.0;
        foreach ($list_data_unsur_pengabdian as $item) {
            $sum_unsur_pengabdian += $item["nilai"];
        }

        $sum_unsur_penunjang = 0.0;
        foreach ($list_data_unsur_penunjang as $item) {
            $sum_unsur_penunjang += $item["nilai"];
        }

        $hasil = $sum_unsur_pendidikan + $sum_unsur_penelitian + $sum_unsur_pengabdian + $sum_unsur_penunjang ;
        // dd($hasil);
       
        $semester = $request -> semester;
        $nip = $request -> nip_pegawai;

        // dd($request->all());

        $data_bukti = [];
        foreach ($request->all() as $key => $value){
            if (str_contains($key, 'bukti')) { 
                $data_bukti += [ $key => $value ];
                // array_push($data_bukti, $value);
            }
        }
        
        // dd($data_bukti);
      
        $data_pertanyaan =[];
        foreach($data_bukti as $key => $item) {  
            
           $kode_bukti = Str::substr($key,6);
           if($kode_bukti){
                $id_pertanyaan = DB::table('pertanyaan')
                            ->where('kode',$kode_bukti)
                            ->first();
                array_push($data_pertanyaan, $id_pertanyaan);
           }
      
        }

        $db_hasil = new Hasil;
        $db_hasil->id_pegawai = $nip;
        $db_hasil->semester = $semester;
        $db_hasil->skor = $hasil;
        $db_hasil->target = $jabfung;
        $db_hasil->save();

        foreach ($data_pertanyaan as $key => $pertanyaan){
            foreach($data_bukti as $a => $value) { 
                // dd(file($value));
                if ($value != NUll) {
                    $bukti = $value;
                    $new_bukti = time()."_".$bukti->getClientOriginalName();
                    // dd($new_bukti);
                    $tujuan_upload = 'file/bukti';
                    $bukti->move($tujuan_upload,$new_bukti);
                    
                        $db_hasil_detail = DB::table('hasil_detail')->insert([
                            'hasil_id' => $db_hasil->id, 
                            'pertanyaan_id' => $data_pertanyaan[$key]->id_pertanyaan, 
                            'bukti' => $new_bukti,
                        ]);
                }else{
                    $db_hasil_detail = DB::table('hasil_detail')->insert([
                        'hasil_id' => $db_hasil->id, 
                        'pertanyaan_id' => $data_pertanyaan[$key]->id_pertanyaan, 
                        'bukti' => Null,
                    ]);
                }
            }

        }

        // foreach($list_pertanyaan_existing as $item){
        //     DB::table('hasil_detail')->insert(
        //         ['id_pegawai' => $nip, 'semester' => $semester, 'skor' => $hasil, 'target' => $jabfung]
        //     );
        // }

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

        // dd($minimal);

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
