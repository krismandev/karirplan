<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelPertanyaan;
use Illuminate\Support\Facades\DB;
use Auth;
class PlanControllerLama extends Controller
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
                        })
                        ->get(); 
                        /*dd($data);*/
        $jabfung = DB::table('jabfung')->get();
        $A_I_A  = modelPertanyaan::where("kode","LIKE","A-I-A%")->get();
        $A_II_A = modelPertanyaan::where("kode","LIKE","A-II-A")->get();
        $A_II_A_3 = modelPertanyaan::where("kode","LIKE","A-II-A-3%")->get();
        return view("plan.input")
            ->with("no", 0)
            ->with("A_I_A", $A_I_A)
            ->with("A_II_A", $A_II_A)
            ->with("A_II_A_3", $A_II_A_3)
            ->with("jabfung", $jabfung)
            ->with("data", $data);
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
       $data_persentase_penelitian = persentase_jabfung_penelitian($jabfung, $data_penelitian);


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
