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
        // dd($listSubUnsur);
        /* UNSUR PENDIDIKAN */

        #KODE A_I_A 
        $A_I_A  = modelPertanyaan::where("kode","LIKE","A-I-A%")->get();

        /* UNSUR PELAKSANAAN PENDIDIKAN */
        
        #KODE A_II_A
        $A_II_A = modelPertanyaan::where("kode","LIKE","A-II-A%")->get();
        #KODE A_II_B
        $A_II_B = modelPertanyaan::where("kode","LIKE","A-II-B%")->get();
        #KODE A_II_C
        $A_II_C = modelPertanyaan::where("kode","LIKE","A-II-C%")->get();
        #KODE A_II_D_1
        $A_II_D_1 = modelPertanyaan::where("kode","LIKE","A-II-D-1%")->get();
        #KODE A_II_D_2
        $A_II_D_2 = modelPertanyaan::where("kode","LIKE","A-II-D-2%")->get();
        #KODE A_II_E
        $A_II_E = modelPertanyaan::where("kode","LIKE","A-II-E%")->get();
        #KODE A_II_F
        $A_II_F = modelPertanyaan::where("kode","LIKE","A-II-F%")->get();
        #KODE A_II_G
        $A_II_G = modelPertanyaan::where("kode","LIKE","A-II-G%")->get();
        #KODE A_II_H
        $A_II_H = modelPertanyaan::where("kode","LIKE","A-II-H%")->get();
        #KODE A_II_I
        $A_II_I = modelPertanyaan::where("kode","LIKE","A-II-I%")->get();
        #KODE A_II_J
        $A_II_J = modelPertanyaan::where("kode","LIKE","A-II-J%")->get();
        #KODE A_II_K
        $A_II_K = modelPertanyaan::where("kode","LIKE","A-II-K%")->get();
        #KODE A_II_L
        $A_II_L = modelPertanyaan::where("kode","LIKE","A-II-L%")->get();
        #KODE A_II_M
        $A_II_M = modelPertanyaan::where("kode","LIKE","A-II-M%")->get();

        /* UNSUR PENELITIAN */

        #KODE B_I_A_1
        $B_I_A_1 = modelPertanyaan::where("kode","LIKE","B-I-A-1%")->get();
        #KODE B_I_A_2
        $B_I_A_2 = modelPertanyaan::where("kode","LIKE","B-I-A-2%")->get();
        #KODE B_I_A_3
        $B_I_A_3 = modelPertanyaan::where("kode","LIKE","B-I-A-3%")->get();
        #KODE B_I_B_1
        $B_I_B_1 = modelPertanyaan::where("kode","LIKE","B-I-B-1%")->get();
        #KODE B_I_B_2
        $B_I_B_2 = modelPertanyaan::where("kode","LIKE","B-I-B-2%")->get();
        #KODE B_I_B_3
        $B_I_B_3 = modelPertanyaan::where("kode","LIKE","B-I-B-3%")->get();
        #KODE B_I_B_4
        $B_I_B_4 = modelPertanyaan::where("kode","LIKE","B-I-B-4%")->get();
        #KODE B_I_B_5
        $B_I_B_5 = modelPertanyaan::where("kode","LIKE","B-I-B-5%")->get();

        #KODE B_I_C
        $B_I_C = modelPertanyaan::where("kode","LIKE","B-I-C%")->get();
        #KODE B_I_D
        $B_I_D = modelPertanyaan::where("kode","LIKE","B-I-D%")->get();
        #KODE B_I_E
        $B_I_E = modelPertanyaan::where("kode","LIKE","B-I-E%")->get();
        #KODE B_I_F
        $B_I_F = modelPertanyaan::where("kode","LIKE","B-I-F%")->get();
        #KODE B_I_G
        $B_I_G = modelPertanyaan::where("kode","LIKE","B-I-G%")->get();
        #KODE B_I_H
        $B_I_H = modelPertanyaan::where("kode","LIKE","B-I-H%")->get();

        /* UNSUR PENGABDIAN MASYARAKAT */

        #KODE C_I_A
        $C_I_A = modelPertanyaan::where("kode","LIKE","C-I-A%")->get();
        #KODE C_I_B
        $C_I_B = modelPertanyaan::where("kode","LIKE","C-I-B%")->get();
        #KODE C_I_C_1
        $C_I_C_1 = modelPertanyaan::where("kode","LIKE","C-I-C-1%")->get();
        #KODE C_I_C_2
        $C_I_C_2 = modelPertanyaan::where("kode","LIKE","C-I-C-2%")->get();
        #KODE C_I_D
        $C_I_D = modelPertanyaan::where("kode","LIKE","C-I-D%")->get();
        #KODE C_I_E
        $C_I_E = modelPertanyaan::where("kode","LIKE","C-I-E%")->get();
        #KODE C_I_F
        $C_I_F = modelPertanyaan::where("kode","LIKE","C-I-F%")->get();
        #KODE C_I_G
        $C_I_G = modelPertanyaan::where("kode","LIKE","C-I-G%")->get();
      
        /* UNSUR PENUNJANG */
        #KODE D_I_A
        $D_I_A = modelPertanyaan::where("kode","LIKE","D-I-A%")->get();
        #KODE D_I_B_1
        $D_I_B_1 = modelPertanyaan::where("kode","LIKE","D-I-B-1%")->get();
        #KODE D_I_B_2
        $D_I_B_2 = modelPertanyaan::where("kode","LIKE","D-I-B-2%")->get();
        #KODE D_I_C_1
        $D_I_C_1 = modelPertanyaan::where("kode","LIKE","D-I-C-1%")->get();
        #KODE D_I_C_2
        $D_I_C_2 = modelPertanyaan::where("kode","LIKE","D-I-C-2%")->get();
        #KODE D_I_D
        $D_I_D = modelPertanyaan::where("kode","LIKE","D-I-D%")->get();
        #KODE D_I_E
        $D_I_E = modelPertanyaan::where("kode","LIKE","D-I-E%")->get();
        #KODE D_I_F_1
        $D_I_F_1 = modelPertanyaan::where("kode","LIKE","D-I-F-1%")->get();
        #KODE D_I_F_2
        $D_I_F_2 = modelPertanyaan::where("kode","LIKE","D-I-F-2%")->get();
        #KODE D_I_G
        $D_I_G = modelPertanyaan::where("kode","LIKE","D-I-G%")->get();
        #KODE D_I_H
        $D_I_H = modelPertanyaan::where("kode","LIKE","D-I-H%")->get();
        #KODE D_I_I
        $D_I_I = modelPertanyaan::where("kode","LIKE","D-I-I%")->get();
        #KODE D_I_J
        $D_I_J = modelPertanyaan::where("kode","LIKE","D-I-J%")->get();

        return view("plan.input")
                ->with("jabfung", $jabfung)->with("data", $data)
                /*Pengabdian*/
                ->with("A_I_A", $A_I_A) 
                /*Penelitian*/
                ->with("A_II_A", $A_II_A)->with("A_II_B", $A_II_B)->with("A_II_C", $A_II_C)
                ->with("A_II_D_1", $A_II_D_1)->with("A_II_D_2", $A_II_D_2)
                ->with("A_II_E", $A_II_E)->with("A_II_F", $A_II_F)->with("A_II_G", $A_II_G)
                ->with("A_II_H", $A_II_H)->with("A_II_I", $A_II_I)->with("A_II_J", $A_II_J)
                ->with("A_II_K", $A_II_K)->with("A_II_L", $A_II_L)->with("A_II_M", $A_II_M)
                ->with("B_I_A_1", $B_I_A_1)->with("B_I_A_2", $B_I_A_2)->with("B_I_A_3", $B_I_A_3)
                ->with("B_I_B_1", $B_I_B_1)->with("B_I_B_2", $B_I_B_2)->with("B_I_B_3", $B_I_B_3)->with("B_I_B_4", $B_I_B_4)->with("B_I_B_5", $B_I_B_5)
                ->with("B_I_C", $B_I_C)->with("B_I_D", $B_I_D)->with("B_I_E", $B_I_E)->with("B_I_F", $B_I_F)->with("B_I_G", $B_I_G)->with("B_I_H", $B_I_H)
               /* Pengabdian Masyarakat */
                ->with("C_I_A", $C_I_A)->with("C_I_B", $C_I_B)->with("C_I_C_1", $C_I_C_1)->with("C_I_C_2", $C_I_C_2)
                ->with("C_I_D", $C_I_D)->with("C_I_E", $C_I_E)->with("C_I_F", $C_I_F)->with("C_I_G", $C_I_G)
                /* Penunjang */
                ->with("D_I_A", $D_I_A)->with("D_I_B_1", $D_I_B_1)->with("D_I_B_2", $D_I_B_2)
                ->with("D_I_C_1", $D_I_C_1)->with("D_I_C_2", $D_I_C_2)
                ->with("D_I_D", $D_I_D)->with("D_I_E", $D_I_E)
                ->with("D_I_F_1", $D_I_F_1)->with("D_I_F_2", $D_I_F_2)
                ->with("D_I_G", $D_I_G)
                ->with("D_I_H", $D_I_H)
                ->with("D_I_I", $D_I_I)
                ->with("D_I_J", $D_I_J);

        

       
        /* QUERY CADANGAN
            #ID UNSUR 1 PENDIDIKAN
            $unsur1 = DB::table('unsur as a')
                    ->join('sub_unsur as b','b.id_unsur','=','a.id_unsur')
                    ->join('pertanyaan as c','c.id_subUnsur','=','b.id_subUnsur')
                    ->where('kode_unsur','A')->where('nama_unsur','Pendidikan')->get();
            #ID UNSUR 2 PENELITIAN
            $unsur2 = DB::table('unsur as a')
                    ->join('sub_unsur as b','b.id_unsur','=','a.id_unsur')
                    ->join('pertanyaan as c','c.id_subUnsur','=','b.id_subUnsur')
                    ->where('kode_unsur','B')->where('nama_unsur','Penelitian')->get();
            // dd($unsur2);
            #ID UNSUR 3 PENGABDIAN MASYARAKAT
            $unsur3 = DB::table('unsur as a')
                    ->join('sub_unsur as b','b.id_unsur','=','a.id_unsur')
                    ->join('pertanyaan as c','c.id_subUnsur','=','b.id_subUnsur')
                    ->where('kode_unsur','C')->where('nama_unsur','Pengabdian Masyarakat')->get();
            #ID UNSUR 4 PENUNJANG
            $unsur4 = DB::table('unsur as a')
                    ->join('sub_unsur as b','b.id_unsur','=','a.id_unsur')
                    ->join('pertanyaan as c','c.id_subUnsur','=','b.id_subUnsur')
                    ->where('kode_unsur','D')->where('nama_unsur','Penunjang')->get();
            #ID UNSUR 5 PELAKSANAAN PENDIDIKAN
            $unsur5 = DB::table('pertanyaan as a')
                    ->join('sub_unsur as b','b.id_subUnsur','=','a.id_subUnsur')
                    ->join('unsur as c','c.id_unsur','=','b.id_unsur')
                    ->where('c.kode_unsur','A')->where('c.nama_unsur','Pelaksanaan Pendidikan')
                    ->get();
            // $unsur5 = DB::table('unsur as a')
            //         ->join('sub_unsur as b','b.id_unsur','=','a.id_unsur')
            //         ->groupby('b.id_subUnsur')
            //         ->get();
            // dd($unsur5);
            // dd($unsur5);

            return view("plan.input")
                    ->with("jabfung", $jabfung)
                    ->with("data", $data)
                    ->with("unsur1", $unsur1)
                    ->with("unsur2", $unsur2)
                    ->with("unsur3", $unsur3)
                    ->with("unsur4", $unsur4)
                    ->with("unsur5", $unsur5);
        */
        
        
    }

    public function store( Request $request){
         function data_yes_no($data, $kredit){
            if($data == 1){
                $hasil = $data * $kredit;
                return $hasil; 
            }
            if($data){
                return 0;
            }
         }

         function data_jabatan($data){
            $hasil = $data;
            return $hasil;
         }

         function data_sks($data, $jabfung){
            if($jabfung = "Asisten Ahli"){
                if($data >= 12){
                    $hasil = 5.5;
                }elseif ($data > 10 && $data <12) {
                    $hasil = 5.0;
                }else{
                    $hasil = $data * 0.5;
                }
                return $hasil;
            }else{
                if($data >= 12){
                    $hasil = 11;
                }elseif ($data > 10 && $data <12) {
                    $hasil = 10;
                }else{
                    $hasil = $data * 1;
                }

                return $hasil;
            }
            }
        function data_max($data, $kredit, $max){
            if($data > $max){
                $hasil = $max * $kredit;
            }else{
                $hasil = $data * $kredit;
            }

            return $hasil;
        }

        $jabfung = $request -> plan_jabfung;
        /*data pendidikan*/
        $data1 = $request -> bag_1_a_no_1;
        $data2 = $request -> bag_1_a_no_2;
        $data3 = $request -> bag_1_a_no_3;

        //data pembelajaran
        $data4 = $request -> bag_2_a_no_1;
        $data5 = $request -> bag_2_b_no_1;
        $data6 = $request -> bag_2_c_no_1;
        $data7 = $request -> bag_2_d_no_1;
        $data8 = $request -> bag_2_d_no_2;
        $data9 = $request -> bag_2_e_no_1;
        $data10 = $request -> bag_2_e_no_2;
        $data11 = $request -> bag_2_f_no_1;
        $data12 = $request -> bag_2_g_no_1;
        $data13 = $request -> bag_2_h_no_1;
        $data14 = $request -> bag_2_h_no_2;
        $data15 = $request -> bag_2_i_no_1;
        $data16 = $request -> bag_2_j_no_1;
        $data17 = $request -> bag_2_k_no_1;
        $data18 = $request -> bag_2_k_no_2;
        $data19 = $request -> bag_2_l_no_1;
        $data20 = $request -> bag_2_l_no_2;
        $data21 = $request -> bag_2_m_no_1;

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
        
        $data_pembelajaran = data_sks($data4, $jabfung) +
                 data_yes_no($data5, 1) + 
                 data_yes_no($data6, 1) + 
                 data_yes_no($data7, 1) + 
                 data_yes_no($data8, 0.5) +
                 data_max($data9, 1, 4) +
                 data_max($data10, 0.5, 8)+
                 data_max($data11, 2, 2)+
                 data_max($data12, 2, 1)+
                 data_max($data13, 10, 1)+
                 data_max($data14, 5, 1)+
                 data_max($data15, 5, 2)+
                 data_jabatan($data16)+
                data_max($data17, 2, 1)+
                data_max($data18, 1, 1)+
                data_max($data19, 5, 1)+
                data_max($data20, 4, 1)+
                data_jabatan($data21);

       $data_persentase_pembelajaran = persentase_jabfung_pembelajaran($jabfung, $data_pembelajaran);

       function data_jumlah($data, $kredit){
            $hasil = $data * $kredit;
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

       /*data penelitian*/
       $data22 = $request -> bag_3_a_no_1;
       $data23 = $request -> bag_3_a_no_2;
       $data24 = $request -> bag_3_a_no_3;
       $data25 = $request -> bag_3_a_no_4;
       $data26 = $request -> bag_3_a_no_5;
       $data27 = $request -> bag_3_a_no_6;
       $data28 = $request -> bag_3_a_no_7;
       $data29 = $request -> bag_3_a_no_8;
       $data30 = $request -> bag_3_a_no_9;
       $data31 = $request -> bag_3_a_no_10;
       $data32 = $request -> bag_3_a_no_11;
       $data33 = $request -> bag_3_a_no_12; 
       $data34 = $request -> bag_3_b_no_1;
       $data35 = $request -> bag_3_b_no_2;
       $data36 = $request -> bag_3_b_no_3;
       $data37 = $request -> bag_3_b_no_4;
       $data38 = $request -> bag_3_b_no_5;
       $data39 = $request -> bag_3_b_no_6;
       $data40 = $request -> bag_3_b_no_7;
       $data41 = $request -> bag_3_b_no_8;
       $data42 = $request -> bag_3_b_no_9;
       $data43 = $request -> bag_3_b_no_10;
       $data44 = $request -> bag_3_b_no_11;
       $data45 = $request -> bag_3_c_no_1;
       $data46 = $request -> bag_3_d_no_1;
       $data47 = $request -> bag_3_e_no_1;
       $data48 = $request -> bag_3_f_no_1;
       $data49 = $request -> bag_3_f_no_2;
       $data50 = $request -> bag_3_g_no_1;
       $data51 = $request -> bag_3_g_no_2;
       $data52 = $request -> bag_3_g_no_3;
     //  $data51 = $request -> bag_3_h_no_1;


       $data_penelitian = data_max($data22, 20, 1)+
                          data_max($data23, 10, 1)+
                          data_max($data24, 7.5, 1)+
                          data_max($data25, 5, 1)+
                          data_jumlah($data26, 40)+
                          data_jumlah($data27,30)+
                          data_jumlah($data28,20)+
                          data_jumlah($data29,25)+
                          data_jumlah($data30,20)+
                          data_jumlah($data31,20)+
                          data_jumlah($data32,10)+
                          data_jumlah($data33,10)+
                          data_jumlah($data34,30)+
                          data_jumlah($data35,25)+
                          data_jumlah($data36,15)+
                          data_jumlah($data37,10)+
                          data_jumlah($data38,5)+
                          data_jumlah($data39,3)+
                          data_jumlah($data40,10)+
                          data_jumlah($data41,5)+
                          data_jumlah($data42,5)+
                          data_jumlah($data43,1)+
                          data_jumlah($data44,2)+
                          data_jumlah($data45,15)+
                          data_jumlah($data46,5)+
                          data_jumlah($data47,3)+
                          data_jumlah($data48,10)+
                          data_jumlah($data49,5)+
                          data_jumlah($data50,1)
                          //data_jumlah($data51,)
                          ;
       $data_persentase_penelitiann = persentase_jabfung_penelitian($jabfung, $data_penelitian);


       function persentase_jabfung_pengabdian($jabfung, $data){
            $hasil = $data * 0.10;

            return $hasil;
        }
       
       //data_pengabdian
       $data53 = $request -> bag_4_a_no_1;
       $data54 = $request -> bag_4_a_no_2;
       $data55 = $request -> bag_4_a_no_3;
       $data56 = $request -> bag_4_a_no_4;
       $data57 = $request -> bag_4_a_no_5;
       $data58 = $request -> bag_4_a_no_6;
       $data59 = $request -> bag_4_a_no_7;
       $data60 = $request -> bag_4_a_no_8;
       $data61 = $request -> bag_4_a_no_9;
       $data62 = $request -> bag_4_a_no_10;
       $data63 = $request -> bag_4_a_no_11;
       $data64 = $request -> bag_4_a_no_12;
       $data65 = $request -> bag_4_a_no_13;

       $data_pengabdian = data_yes_no($data53, 5.5)+
                          data_jumlah($data54, 3)+
                          data_jumlah($data55, 4)+
                          data_jumlah($data56, 3)+
                          data_jumlah($data57, 2)+
                          data_jumlah($data58, 3)+
                          data_jumlah($data59, 2)+
                          data_jumlah($data60, 1)+
                          data_jumlah($data61, 1)+
                          data_jumlah($data62, 1.5)+
                          data_jumlah($data63, 1)+
                          data_jumlah($data64, 0.5)+
                          data_jumlah($data65, 3);      

       $data_persentase_pengabdian = persentase_jabfung_pengabdian($jabfung, $data_pengabdian);

       function persentase_jabfung_penunjang($jabfung, $data){
            $hasil = $data * 0.10;
            
            return $hasil;
        }
       
       //data_penunjang
       $data66 = $request -> bag_5_a_no_1;
       $data67 = $request -> bag_5_a_no_2;
       $data68 = $request -> bag_5_b_no_1;
       $data69 = $request -> bag_5_b_no_2;
       $data70 = $request -> bag_5_b_no_3;
       $data71 = $request -> bag_5_b_no_4;
       $data72 = $request -> bag_5_c_no_1;
       $data73 = $request -> bag_5_c_no_2;
       $data74 = $request -> bag_5_c_no_3;
       $data75 = $request -> bag_5_c_no_4;
       $data76 = $request -> bag_5_c_no_5;
       $data77 = $request -> bag_5_c_no_6;
       $data78 = $request -> bag_5_d_no_1;
       $data79 = $request -> bag_5_e_no_1;
       $data80 = $request -> bag_5_e_no_2;
       $data81 = $request -> bag_5_f_no_1;
       $data82 = $request -> bag_5_f_no_2;
       $data83 = $request -> bag_5_g_no_1;
       $data84 = $request -> bag_5_g_no_2;
       $data85 = $request -> bag_5_g_no_3;
       $data86 = $request -> bag_5_g_no_4;
       $data87 = $request -> bag_5_h_no_1;
       $data88 = $request -> bag_5_h_no_2;
       $data89 = $request -> bag_5_h_no_3;
       $data90 = $request -> bag_5_h_no_4;
       $data91 = $request -> bag_5_h_no_5;
       $data92 = $request -> bag_5_h_no_6;
       $data93 = $request -> bag_5_i_no_1;
       $data94 = $request -> bag_5_i_no_2;
       $data95 = $request -> bag_5_i_no_3;
       $data96 = $request -> bag_5_j_no_1;
       $data97 = $request -> bag_5_j_no_2;
       $data98 = $request -> bag_5_j_no_3;
       $data99 = $request -> bag_5_k_no_1;


       $data_penunjang = data_yes_no($data66, 1.5)+
                         data_yes_no($data67, 1)+
                         data_jumlah($data68, 3)+
                         data_jumlah($data69, 2)+
                         data_jumlah($data70, 2)+
                         data_jumlah($data71, 1)+
                         data_yes_no($data72, 2)+
                         data_yes_no($data73, 1)+
                         data_yes_no($data74, 0.5)+
                         data_yes_no($data75, 1.5)+
                         data_yes_no($data76, 1)+
                         data_yes_no($data77, 0.5)+
                         data_jumlah($data78, 1)+
                         data_jumlah($data79, 3)+
                         data_jumlah($data80, 2)+
//                       data_yes_no($data81, )+
//                       data_yes_no($data82, )+
                         data_jumlah($data83, 3)+
                         data_jumlah($data84, 2)+
                         data_jumlah($data85, 2)+
                         data_jumlah($data86, 1)+
                         data_yes_no($data87, 3)+
                         data_yes_no($data88, 2)+
                         data_yes_no($data89, 1)+
                         data_jumlah($data90, 5)+
                         data_jumlah($data91, 3)+
                         data_jumlah($data92, 1)+

                         data_jumlah($data93, 5)+
                         data_jumlah($data94, 5)+
                         data_jumlah($data95, 5)+

                         data_jumlah($data96, 5)+
                         data_jumlah($data97, 3)+
                         data_jumlah($data98, 1)+

                         data_yes_no($data99, 0.5);


       $data_persentase_penunjang = persentase_jabfung_penunjang($jabfung, $data_penunjang);

        $hasil = data_yes_no($data1, 200) + 
                 data_yes_no($data2, 150) + 
                 data_yes_no($data3, 3) +
                 $data_persentase_pembelajaran+
                 $data_persentase_penelitiann+
                 $data_persentase_pengabdian+
                 $data_persentase_penunjang;
        //$data_persentase_pembelajaran;

                 $semester = $request -> semester;
                 $nip = $request -> nip_pegawai;

                 DB::table('hasil')->insert(
                ['id_pegawai' => $nip, 'semester' => $semester, 'skor' => $hasil, 'target' => $jabfung]
                );
           return redirect('/hasil_plan');
    }
}
