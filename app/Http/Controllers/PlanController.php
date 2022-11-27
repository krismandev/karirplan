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
        
        
        // /* UNSUR PENDIDIKAN */

        // #KODE A_I_A 
        // $A_I_A  = modelPertanyaan::where("kode","LIKE","A-I-A%")->get();

        // /* UNSUR PELAKSANAAN PENDIDIKAN */
        
        // #KODE A_II_A
        // $A_II_A = modelPertanyaan::where("kode","LIKE","A-II-A%")->get();
        // #KODE A_II_B
        // $A_II_B = modelPertanyaan::where("kode","LIKE","A-II-B%")->get();
        // #KODE A_II_C
        // $A_II_C = modelPertanyaan::where("kode","LIKE","A-II-C%")->get();
        // #KODE A_II_D_1
        // $A_II_D_1 = modelPertanyaan::where("kode","LIKE","A-II-D-1%")->get();
        // #KODE A_II_D_2
        // $A_II_D_2 = modelPertanyaan::where("kode","LIKE","A-II-D-2%")->get();
        // #KODE A_II_E
        // $A_II_E = modelPertanyaan::where("kode","LIKE","A-II-E%")->get();
        // #KODE A_II_F
        // $A_II_F = modelPertanyaan::where("kode","LIKE","A-II-F%")->get();
        // #KODE A_II_G
        // $A_II_G = modelPertanyaan::where("kode","LIKE","A-II-G%")->get();
        // #KODE A_II_H
        // $A_II_H = modelPertanyaan::where("kode","LIKE","A-II-H%")->get();
        // #KODE A_II_I
        // $A_II_I = modelPertanyaan::where("kode","LIKE","A-II-I%")->get();
        // #KODE A_II_J
        // $A_II_J = modelPertanyaan::where("kode","LIKE","A-II-J%")->get();
        // #KODE A_II_K
        // $A_II_K = modelPertanyaan::where("kode","LIKE","A-II-K%")->get();
        // #KODE A_II_L
        // $A_II_L = modelPertanyaan::where("kode","LIKE","A-II-L%")->get();
        // #KODE A_II_M
        // $A_II_M = modelPertanyaan::where("kode","LIKE","A-II-M%")->get();

        // /* UNSUR PENELITIAN */

        // #KODE B_I_A_1
        // $B_I_A_1 = modelPertanyaan::where("kode","LIKE","B-I-A-1%")->get();
        // #KODE B_I_A_2
        // $B_I_A_2 = modelPertanyaan::where("kode","LIKE","B-I-A-2%")->get();
        // #KODE B_I_A_3
        // $B_I_A_3 = modelPertanyaan::where("kode","LIKE","B-I-A-3%")->get();
        // #KODE B_I_B_1
        // $B_I_B_1 = modelPertanyaan::where("kode","LIKE","B-I-B-1%")->get();
        // #KODE B_I_B_2
        // $B_I_B_2 = modelPertanyaan::where("kode","LIKE","B-I-B-2%")->get();
        // #KODE B_I_B_3
        // $B_I_B_3 = modelPertanyaan::where("kode","LIKE","B-I-B-3%")->get();
        // #KODE B_I_B_4
        // $B_I_B_4 = modelPertanyaan::where("kode","LIKE","B-I-B-4%")->get();
        // #KODE B_I_B_5
        // $B_I_B_5 = modelPertanyaan::where("kode","LIKE","B-I-B-5%")->get();

        // #KODE B_I_C
        // $B_I_C = modelPertanyaan::where("kode","LIKE","B-I-C%")->get();
        // #KODE B_I_D
        // $B_I_D = modelPertanyaan::where("kode","LIKE","B-I-D%")->get();
        // #KODE B_I_E
        // $B_I_E = modelPertanyaan::where("kode","LIKE","B-I-E%")->get();
        // #KODE B_I_F
        // $B_I_F = modelPertanyaan::where("kode","LIKE","B-I-F%")->get();
        // #KODE B_I_G
        // $B_I_G = modelPertanyaan::where("kode","LIKE","B-I-G%")->get();
        // #KODE B_I_H
        // $B_I_H = modelPertanyaan::where("kode","LIKE","B-I-H%")->get();

        // /* UNSUR PENGABDIAN MASYARAKAT */

        // #KODE C_I_A
        // $C_I_A = modelPertanyaan::where("kode","LIKE","C-I-A%")->get();
        // #KODE C_I_B
        // $C_I_B = modelPertanyaan::where("kode","LIKE","C-I-B%")->get();
        // #KODE C_I_C_1
        // $C_I_C_1 = modelPertanyaan::where("kode","LIKE","C-I-C-1%")->get();
        // #KODE C_I_C_2
        // $C_I_C_2 = modelPertanyaan::where("kode","LIKE","C-I-C-2%")->get();
        // #KODE C_I_D
        // $C_I_D = modelPertanyaan::where("kode","LIKE","C-I-D%")->get();
        // #KODE C_I_E
        // $C_I_E = modelPertanyaan::where("kode","LIKE","C-I-E%")->get();
        // #KODE C_I_F
        // $C_I_F = modelPertanyaan::where("kode","LIKE","C-I-F%")->get();
        // #KODE C_I_G
        // $C_I_G = modelPertanyaan::where("kode","LIKE","C-I-G%")->get();
      
        // /* UNSUR PENUNJANG */
        // #KODE D_I_A
        // $D_I_A = modelPertanyaan::where("kode","LIKE","D-I-A%")->get();
        // #KODE D_I_B_1
        // $D_I_B_1 = modelPertanyaan::where("kode","LIKE","D-I-B-1%")->get();
        // #KODE D_I_B_2
        // $D_I_B_2 = modelPertanyaan::where("kode","LIKE","D-I-B-2%")->get();
        // #KODE D_I_C_1
        // $D_I_C_1 = modelPertanyaan::where("kode","LIKE","D-I-C-1%")->get();
        // #KODE D_I_C_2
        // $D_I_C_2 = modelPertanyaan::where("kode","LIKE","D-I-C-2%")->get();
        // #KODE D_I_D
        // $D_I_D = modelPertanyaan::where("kode","LIKE","D-I-D%")->get();
        // #KODE D_I_E
        // $D_I_E = modelPertanyaan::where("kode","LIKE","D-I-E%")->get();
        // #KODE D_I_F_1
        // $D_I_F_1 = modelPertanyaan::where("kode","LIKE","D-I-F-1%")->get();
        // #KODE D_I_F_2
        // $D_I_F_2 = modelPertanyaan::where("kode","LIKE","D-I-F-2%")->get();
        // #KODE D_I_G
        // $D_I_G = modelPertanyaan::where("kode","LIKE","D-I-G%")->get();
        // #KODE D_I_H
        // $D_I_H = modelPertanyaan::where("kode","LIKE","D-I-H%")->get();
        // #KODE D_I_I
        // $D_I_I = modelPertanyaan::where("kode","LIKE","D-I-I%")->get();
        // #KODE D_I_J
        // $D_I_J = modelPertanyaan::where("kode","LIKE","D-I-J%")->get();

        // return view("plan.input")
        //         ->with("jabfung", $jabfung)->with("data", $data)
        //         /*Pengabdian*/
        //         ->with("A_I_A", $A_I_A) 
        //         /*Penelitian*/
        //         ->with("A_II_A", $A_II_A)->with("A_II_B", $A_II_B)->with("A_II_C", $A_II_C)
        //         ->with("A_II_D_1", $A_II_D_1)->with("A_II_D_2", $A_II_D_2)
        //         ->with("A_II_E", $A_II_E)->with("A_II_F", $A_II_F)->with("A_II_G", $A_II_G)
        //         ->with("A_II_H", $A_II_H)->with("A_II_I", $A_II_I)->with("A_II_J", $A_II_J)
        //         ->with("A_II_K", $A_II_K)->with("A_II_L", $A_II_L)->with("A_II_M", $A_II_M)
        //         ->with("B_I_A_1", $B_I_A_1)->with("B_I_A_2", $B_I_A_2)->with("B_I_A_3", $B_I_A_3)
        //         ->with("B_I_B_1", $B_I_B_1)->with("B_I_B_2", $B_I_B_2)->with("B_I_B_3", $B_I_B_3)->with("B_I_B_4", $B_I_B_4)->with("B_I_B_5", $B_I_B_5)
        //         ->with("B_I_C", $B_I_C)->with("B_I_D", $B_I_D)->with("B_I_E", $B_I_E)->with("B_I_F", $B_I_F)->with("B_I_G", $B_I_G)->with("B_I_H", $B_I_H)
        //        /* Pengabdian Masyarakat */
        //         ->with("C_I_A", $C_I_A)->with("C_I_B", $C_I_B)->with("C_I_C_1", $C_I_C_1)->with("C_I_C_2", $C_I_C_2)
        //         ->with("C_I_D", $C_I_D)->with("C_I_E", $C_I_E)->with("C_I_F", $C_I_F)->with("C_I_G", $C_I_G)
        //         /* Penunjang */
        //         ->with("D_I_A", $D_I_A)->with("D_I_B_1", $D_I_B_1)->with("D_I_B_2", $D_I_B_2)
        //         ->with("D_I_C_1", $D_I_C_1)->with("D_I_C_2", $D_I_C_2)
        //         ->with("D_I_D", $D_I_D)->with("D_I_E", $D_I_E)
        //         ->with("D_I_F_1", $D_I_F_1)->with("D_I_F_2", $D_I_F_2)
        //         ->with("D_I_G", $D_I_G)
        //         ->with("D_I_H", $D_I_H)
        //         ->with("D_I_I", $D_I_I)
        //         ->with("D_I_J", $D_I_J);        
        
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
                dd($e->getMessage());
            }
        }

        return $data;
    }

    public function store( Request $request){
        // dd($request->all());
        //jabfung tujuan. nilai ny angka kredit tujuan
        $jabfung = $request -> plan_jabfung;

        $list_pertanyaan_existing = modelPertanyaan::all();
        $list_data_unsur_pendidikan = $this->hitungUnsurPendidikan($request,$list_pertanyaan_existing);

        


        $sum_unsur_pendidikan = 0.0;
        foreach ($list_data_unsur_pendidikan as $item) {
            $sum_unsur_pendidikan += $item["nilai"];
        }

        // dd($sum_unsur_pendidikan);
        dd($this->persentase_jabfung_pembelajaran($jabfung, $sum_unsur_pendidikan));   

    //    $data_persentase_pembelajaran = persentase_jabfung_pembelajaran($jabfung, $data_pembelajaran);

      

    
                          ;
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

    function persentase_jabfung_pembelajaran($jabfung, $data){
        if($jabfung == 100 or $jabfung == 150){
             $hasil = $data * 0.55;
        }elseif($jabfung == 200 or $jabfung == 300){
            $hasil = $data * 0.45;
        }elseif($jabfung == 400 or $jabfung == 550 or $jabfung == 700){
             $hasil = $data * 0.40;
        }elseif($jabfung == 850 or $jabfung == 1050){
             $hasil = $data * 0.35;
        }else{
            $hasil = 0;
        }
        return $hasil;
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
