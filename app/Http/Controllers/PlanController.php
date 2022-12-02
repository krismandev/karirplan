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
use App\HasilDetail;
use App\Jabfung;
use App\JabfungSementara;
use App\modelJabatan;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
        $jabfung_sementara = JabfungSementara::where("id_pegawai",$data[0]->id_pegawai)->orderBy("created_at","desc")->first();
        

        return view("plan.input")
                ->with("jabfung", $jabfung)->with("data", $data)
                /*Pengabdian*/
                ->with("listUnsur", $listUnsur) 
                ->with("listSubUnsur", $listSubUnsur) 
                ->with("listPertanyaan", $listPertanyaan)
                ->with("listPertanyaanDropdown", $listPertanyaanDropdown)
                ->with("jabfung_sementara",$jabfung_sementara);
        
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
    
    
                            $data[$pertanyaan->id_pertanyaan] = [
                                "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                "jawaban"=>$value,
                                "nilai"=>$kredit
                            ];
    
                            // array_push($data,$push);
                            break;
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
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
    
    
                            $data[$pertanyaan->id_pertanyaan] = [
                                "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                "jawaban"=>$value,
                                "nilai"=>$kredit
                            ];
    
                            // array_push($data,$push);
                            break;
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
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
    
    
                            $data[$pertanyaan->id_pertanyaan] = [
                                "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                "jawaban"=>$value,
                                "nilai"=>$kredit
                            ];
    
                            // array_push($data,$push);
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
    
    
                            $data[$pertanyaan->id_pertanyaan] = [
                                "pertanyaan_id"=>$pertanyaan->id_pertanyaan,
                                "jawaban"=>$value,
                                "nilai"=>$kredit
                            ];
    
                            // array_push($data,$push);
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
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required',
            'plan_jabfung' => 'required',
        ]);

        dd($request->all());


        if ($validator->fails())
        {
            // $messages = $validator->messages();
            // $error_message = '';
            // foreach ($messages as $) {
            //     # code...
            // }
            $messages = $validator->errors();
            $err_message = implode('', $messages->all(':message'));
            // return Redirect::back()->withErrors($validator);
            $resp = [
                "type"=>"error",
                "message"=>$err_message
            ];
            return response()->json($resp,400);
        }
        $jabfung = $request->plan_jabfung;
        $jabfung_saat_ini = $request->jabfung_saat_ini;
        if ($jabfung_saat_ini >= $jabfung) {
            $resp = [
                "type"=>"error",
                "message"=>"Tidak dapat memilih jabatan ini"
            ];

            return response()->json($resp,400);
        }

        $list_pertanyaan_existing = modelPertanyaan::all();
        $list_jawaban_unsur_pendidikan = $this->hitungUnsurPendidikan($request,$list_pertanyaan_existing);
        $list_jawaban_unsur_penelitian = $this->hitungUnsurPenelitian($request,$list_pertanyaan_existing);
        $list_jawaban_unsur_pengabdian = $this->hitungUnsurPengabdian($request,$list_pertanyaan_existing);
        $list_jawaban_unsur_penunjang = $this->hitungUnsurPenunjang($request,$list_pertanyaan_existing);
        
        
        //filter yg jawabanny diisi saja
        $list_pertanyaan_id = [];
        $list_jawaban_unsur_pendidikan = array_filter($list_jawaban_unsur_pendidikan,function($item){
            return ($item["jawaban"] != "0" && $item["jawaban"] != null);
        });
        $list_jawaban_unsur_penelitian = array_filter($list_jawaban_unsur_penelitian,function($item){
            return ($item["jawaban"] != "0" && $item["jawaban"] != null);
        });
        $list_jawaban_unsur_pengabdian = array_filter($list_jawaban_unsur_pengabdian,function($item){
            return ($item["jawaban"] != "0" && $item["jawaban"] != null);
        });
        $list_jawaban_unsur_penunjang = array_filter($list_jawaban_unsur_penunjang,function($item){
            return ($item["jawaban"] != "0" && $item["jawaban"] != null);
        });
        
        
     
        $sum_unsur_pendidikan = 0.0;
        foreach ($list_jawaban_unsur_pendidikan as $item) {
            $sum_unsur_pendidikan += $item["nilai"];
            $list_pertanyaan_id[] = $item["pertanyaan_id"];
        }

        $sum_unsur_penelitian= 0.0;
        foreach($list_jawaban_unsur_penelitian as $item){
            $sum_unsur_penelitian += $item["nilai"];
            $list_pertanyaan_id[] = $item["pertanyaan_id"];
        }

        $sum_unsur_pengabdian = 0.0;
        foreach ($list_jawaban_unsur_pengabdian as $item) {
            $sum_unsur_pengabdian += $item["nilai"];
            $list_pertanyaan_id[] = $item["pertanyaan_id"];
        }

        $sum_unsur_penunjang = 0.0;
        foreach ($list_jawaban_unsur_penunjang as $item) {
            $sum_unsur_penunjang += $item["nilai"];
            $list_pertanyaan_id[] = $item["pertanyaan_id"];
        }
        

        // dd($list_pertanyaan_id);

        $hasil_unsur_pendidikan = $this->persentase_jabfung_pendidikan($jabfung,$sum_unsur_pendidikan);
        $hasil_unsur_penelitian = $this->persentase_jabfung_penelitian($jabfung,$sum_unsur_penelitian);
        $hasil_unsur_pengabdian = $this->persentase_jabfung_pengabdian($jabfung,$sum_unsur_pengabdian);
        $hasil_unsur_penunjang = $this->persentase_jabfung_penunjang($jabfung,$sum_unsur_penunjang);

        $list_semua_pertanyaan_dijawab = array_merge($list_jawaban_unsur_pendidikan,$list_jawaban_unsur_penelitian,$list_jawaban_unsur_pengabdian,$list_jawaban_unsur_penunjang);

        // komen dlu. ganggu
        if ($hasil_unsur_pendidikan["mencapaiMinimum"] == false) {
            $resp = [
                "type"=>"error",
                "message"=>"Angka kredit pada unsur Pendidikan belum mencapai persentase minimum"
            ];

            return response()->json($resp,400);
        }
        if ($hasil_unsur_penelitian["mencapaiMinimum"] == false) {
            $resp = [
                "type"=>"error",
                "message"=>"Angka kredit pada unsur Penelitian belum mencapai persentase minimum"
            ];

            return response()->json($resp,400);
        }

        $hasil = $hasil_unsur_pendidikan["hasil"] + $hasil_unsur_penelitian["hasil"] + $hasil_unsur_pengabdian + $hasil_unsur_penunjang ;
        // dd($hasil);
       
        $semester = $request -> semester;
        $id_pegawai = $request -> id_pegawai;

        $db_hasil = new Hasil;
        $db_hasil->id_pegawai = $id_pegawai;
        $db_hasil->semester = $semester;
        $db_hasil->skor = $hasil;
        $db_hasil->target = $jabfung;
        $db_hasil->save();

        $data_detail = [];
        foreach ($list_semua_pertanyaan_dijawab as $key => $value) {
            $pertanyaan = $list_pertanyaan_existing->where("id_pertanyaan",$value["pertanyaan_id"])->first();
        //    dd( $request->get("bukti_".$pertanyaan->kode));
            // dd($pertanyaan);

            
            $file_gambar = $request->file("bukti_".$pertanyaan->kode);
            $nama_file_gambar = null;
            if ($file_gambar != null) {
                $nama_file_gambar = time()."_".$file_gambar->getClientOriginalName();
                $path = "file/bukti";
                $file_gambar->move($path,$nama_file_gambar);
                // $type_file = "file";
            }else{
                //berarti text
                $link = $request->get("bukti_".$pertanyaan->kode);
                // $type_url = "url";
            }

            if($nama_file_gambar){
                $type_bukti = "file";
            }elseif($link){
                $type_bukti = 'link';
            }else{
                $type_bukti = "tidak diupload";
            }
            $data = [
                "hasil_id"=>$db_hasil->id,
                "pertanyaan_id"=>$value["pertanyaan_id"],
                "kredit"=>$value["nilai"],
                "bukti"=>$nama_file_gambar ?? $link ,
                "jawaban"=>$value["jawaban"],
                "type_bukti"=> $type_bukti,
            
            ];
            $data_detail[]=$data;
        }

        if ($hasil >= $jabfung) {
            $jabfung = Jabfung::where("angka_kredit",$jabfung)->first();
            JabfungSementara::create([
                "id_jabfung"=>$jabfung->id_jabfung,
                "id_pegawai"=>$id_pegawai,
            ]);
        }

        // dd($data_detail);

        HasilDetail::insert($data_detail);
        // foreach ($data_pertanyaan as $key => $pertanyaan){
        //     foreach($data_bukti as $a => $value) { 
        //         // dd(file($value));
        //         if ($value != NUll) {
        //             $bukti = $value;
        //             $new_bukti = time()."_".$bukti->getClientOriginalName();
        //             // dd($new_bukti);
        //             $tujuan_upload = 'file/bukti';
        //             $bukti->move($tujuan_upload,$new_bukti);
                    
        //                 $db_hasil_detail = DB::table('hasil_detail')->insert([
        //                     'hasil_id' => $db_hasil->id, 
        //                     'pertanyaan_id' => $data_pertanyaan[$key]->id_pertanyaan, 
        //                     'bukti' => $new_bukti,
        //                 ]);
        //         }else{
        //             $db_hasil_detail = DB::table('hasil_detail')->insert([
        //                 'hasil_id' => $db_hasil->id, 
        //                 'pertanyaan_id' => $data_pertanyaan[$key]->id_pertanyaan, 
        //                 'bukti' => Null,
        //             ]);
        //         }
        //     }



        // }

        // foreach($list_pertanyaan_existing as $item){
        //     DB::table('hasil_detail')->insert(
        //         ['id_pegawai' => $id_pegawai, 'semester' => $semester, 'skor' => $hasil, 'target' => $jabfung]
        //     );
        // }

        $resp = [
            "type"=>"success",
            "message"=>"Berhasil input plan",
            "redirect"=>"/hasil_plan"
        ];

        return response()->json($resp);
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
            "mencapaiMinimum"=>$mencapaiMinimum,
            "hasil"=>$hasil
        ];
        return $data;
    }

    function persentase_jabfung_penelitian($jabfung, $data){
        if($jabfung == 100 or $jabfung == 150){
            $minimal = $jabfung * 0.25;
            $hasil = $data;
        }elseif($jabfung == 200 or $jabfung == 300){
            $minimal = $jabfung * 0.35;
            $hasil = $data;
        }elseif($jabfung == 400 or $jabfung == 550 or $jabfung == 700){
            $minimal = $jabfung * 0.40;
            $hasil = $data;
        }elseif($jabfung == 850 or $jabfung == 1050){
            $minimal = $jabfung * 0.45;
            $hasil = $data;
        }else{
            $hasil = 0;
        }
        if ($hasil > $minimal) {
            $mencapaiMinimum = true;
        }else {
            $mencapaiMinimum = false;
        }

        $data = [
            "mencapaiMinimum"=>$mencapaiMinimum,
            "hasil"=>$hasil
        ];

        return $data;
    }

    function persentase_jabfung_pengabdian($jabfung, $data){
        $maksimal = $jabfung * 0.1;

        if ($data >= $maksimal) {
            return $maksimal;
        }
        return $data;
    }

    function persentase_jabfung_penunjang($jabfung, $data){
        $maksimal = $jabfung * 0.1;

        if ($data >= $maksimal) {
            return $maksimal;
        }
        return $data;
    }
}
