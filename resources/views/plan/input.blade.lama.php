@extends("layouts.app")
@section("konten")
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Identitas Perencana</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
             <div class="table-box">
                <table class="table">
                    <tbody>
                        <form action="{{ route('kirim_plan') }}" method="post">
                              {{ csrf_field() }}
                    @foreach($data as $item)
                        <tr>
                            <td width="30%;">
                                Nama : 
                            </td>
                            <td>
                               {{$item -> gelar_depan}} {{ $item -> nama_pegawai }}, {{$item->gelar_belakang}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NIP :
                            </td>
                            <td>
                                {{ $item -> nip }}
                                <input type="hidden" name="nip_pegawai" value="{{ $item -> id_pegawai }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jabatan Fungsional saat ini :
                            </td>
                            <td>
                                {{ $item -> nama_jabfung }}    
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                Jabatan Fungsional yang direncanakan :
                            </td>
                            <td>
                                <select name="plan_jabfung" class="form-control" style="width: 30%;" id="plan_jabfung">
                                    <option value="0">Pilih Jabatan Fungsional</option>
                                    @foreach($jabfung as $option)
                                    <option value="{{$option -> angka_kredit}}">{{ $option -> nama_jabfung }} - {{ $option -> angka_kredit }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="col-xs-12">
<div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Perencanaan Kenaikan Pangkat</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-9">Pertanyaan</th>
                            <th class="col-md-4">Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Nama Semester: 
                            </td>
                            <td>
                                <input type="text" name="semester" class="form-control" maxlength="15" placeholder="Contoh: 20181" id="namaSemester">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tanggal Mulai Semester:
                            </td>
                            <td>
                                <input type="date" name="" class="form-control" id="awalSemester" placeholder="Contoh: 01/01/2018">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tanggal Akhir Semester:
                            </td>
                            <td>
                                <input type="date" name="" class="form-control" id="akhirSemester" placeholder="Contoh: 01/01/2018">
                            </td>
                        </tr>
                    </tbody>
                     <thead>
                        <tr>
                            <th class="col-md-9">Angka kredit saat ini</th>
                            <th class="col-md-4">Angka kredit yang direncanakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                 @foreach($data as $item)
                                   {{ $item -> angka_kredit }}
                                 @endforeach
                            </td>
                            <td>
                                <span id="plan_kredit"></span>
                                <input type="hidden" name="jabfung" id="plan_kredit">
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Perencanaan Unsur Pendidikan</h2>
        </header>
        <div class="contents">  
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-0">No</th>
                            <th class="col-md-9">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bold uppercase">
                            <td class="parentJudul">I</td>
                            <td colspan="3">Unsur Pendidikan</td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">A</td>
                            <td colspan="3">Pendidikan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Apakah semester ini Anda sudah lulus S3-Doktor?</td>
                            <td>
                                <select class="selectize" id="bag_1_a_no_1" name="bag_1_a_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr id="bag_1_a_no_2">
                            <td></td>
                            <td>2. Apakah semester ini Anda sudah lulus S2-Magister?</td>
                            <td>
                                <select class="selectize" name="bag_1_a_no_2">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Apakah semester ini Anda mengikuti diklat prajabatan golongan III?</td>
                            <td>
                                <select class="selectize" id="A-II-B" name="bag_1_a_no_3">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr class="bold uppercase">
                            <td class="parentJudul">II</td>
                            <td colspan="3">Unsur Pelaksanaan Pendidikan</td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">A</td>
                            <td colspan="3">melaksanakan perkuliahan/tutorial/perkuliahan, praktikum, membimbing, menguji, serta menyelenggarakan pendidikan di laboratorium, praktik keguruan, bengkel/sudio/kebun percobaan/teknologi pengajaran dan praktik lapangan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Berapakah beban SKS Anda mengajar pada semester ini?</td>
                            <td>
                            <div class="input-group">
                            <input type="text" id="bag-2-a-no-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_a_no_1">
                            <span class="input-group-addon btn-default">SKS</span>
                            </div>
                        </td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">B</td>
                            <td colspan="3">Membimbing seminar mahasiswa (setiap semester)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pada semester ini apakah Anda ikut membimbing seminar mahasiswa?</td>
                            <td>
                                <select class="selectize" id="A-II-B" name="bag_2_b_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">C</td>
                            <td colspan="3">Membimbing KKN, PKN, dan PKL (Setiap Semester)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pada semester ini apakah Anda ikut membimbing KKN, PKN, dan PKL?</td>
                            <td>
                                <select class="selectize" id="A-II-C" name="bag_2_c_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">D</td>
                            <td colspan="3">Membimbing dan ikut membimbing dalam menghasilkan disertasi, tersis, skripsi, dan laporan akhir studi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Apakah pada semester ini Anda akan menjadi pembimbing utama?</td>
                            <td>
                                <select class="selectize" name="bag_2_d_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td class="subASK">a. Berapakah jumlah lulusan mahasiswa S-3 yang akan Anda bimbing?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-D-1-a" class="form-control A-II-D-1" value="0" onkeypress="return validasi_number(event)" maxlength="3" disabled="disabled">
                                    <span class="input-group-addon btn-default">Lulusan</span>
                                </div>
                            </td>
                           <td>
                                #PTS
                            </td> 
                        </tr>-->
                       <!--  <tr>
                            <td></td>
                            <td class="subASK">b. Berapakah jumlah lulusan mahasiswa S-2 yang akan Anda bimbing?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-D-1-b" class="form-control A-II-D-1" value="0" onkeypress="return validasi_number(event)" maxlength="3" disabled="disabled">
                                    <span class="input-group-addon btn-default">Lulusan</span>
                                </div>
                            </td>
                             <td>
                                #PTS
                            </td> </tr> -->
                        <!-- <tr>
                            <td></td>
                            <td class="subASK">c. Berapakah jumlah lulusan mahasiswa S-1 yang akan Anda bimbing?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-D-1-c" class="form-control A-II-D-1" value="0" onkeypress="return validasi_number(event)" maxlength="3" disabled="disabled">
                                    <span class="input-group-addon btn-default">Lulusan</span>
                                </div>
                            </td>
                           <td>
                                #PTS
                            </td>
                        </tr> -->
                        
                       
                       <!--  <tr>
                            <td></td>
                            <td class="subASK">a. Berapakah jumlah lulusan mahasiswa S-3 yang akan Anda bimbing?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-D-2-a" class="form-control A-II-D-2" value="0" onkeypress="return validasi_number(event)" maxlength="3" disabled="disabled">
                                    <span class="input-group-addon btn-default">Lulusan</span>
                                </div>
                            </td>
                             <td>
                                #PTS
                            </td>
                        </tr> -->
                       
                        <tr class="bold uppercase">
                            <td class="subJudul">E</td>
                            <td colspan="3">Bertugas sebagai penguji pada ujian akhir/profesi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Berapa jumlah lulusan yang akan Anda uji sebagai ketua penguji?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-E-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_e_no_1">
                                    <span class="input-group-addon btn-default">Lulusan</span>
                                </div>
                            </td>
                           <!--  <td>
                                #PTS
                            </td>  -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Berapa jumlah lulusan yang akan Anda uji sebagai anggota penguji?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-E-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_e_no_2">
                                    <span class="input-group-addon btn-default">Lulusan</span>
                                </div>
                            </td>
                           <!-- <td>
                                #PTS
                            </td>  -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">F</td>
                            <td colspan="3">Membina kegiatan mahasiswa dibidang akademik dan kemahasiswaan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Berapa jumlah kegiatan mahasiswa yang Anda bina pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-F" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_f_no_1">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">G</td>
                            <td colspan="3">Mengembangkan program kuliah yang mempunyai nilai kebagharuan metode atau substansi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Berapa jumlah matakuliah yang Anda kembangkan pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-G" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_g_no_1">
                                    <span class="input-group-addon btn-default">MK</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> --> 
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">H</td>
                            <td colspan="3">Mengembangkan bahan pengajaran/bahan kuliah yang memiliki nilai kebaharuan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Berapakah jumlah buku ajar yang Anda kembangkan pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-H-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_h_no_1">
                                    <span class="input-group-addon btn-default">Buku</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Berapakah diktat, modul, petunjuk praktikum, model, alat bantu, audio visual, naskah tutorial, <i>job sheet</i> praktikum yang telah Anda kembangkan pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-H-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_h_no_2">
                                    <span class="input-group-addon btn-default">Produk</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">I</td>
                            <td colspan="3">Menyampaikan orasi ilmiah di tingkat perguruan tinggi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Berapakalikah Anda menyampaikan orasi ilmiah di perguruan tinggi pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-I" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_i_no_1">
                                    <span class="input-group-addon btn-default">Orasi</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">J</td>
                            <td colspan="3">Menduduki jabatan pimpinan perguruan tinggi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jabatan apakah yang Anda duduki pada semseter ini?</td>
                            <td colspan="2">
                                <select class="selectize" id="A-II-J" name="bag_2_j_no_1">
                                    <!-- harus ambil dari db -->
                                    <option value="0" selected>Tidak Ada</option>
                                    <option value="6">Rektor</option>
                                    <option value="5">Wakil Rektor/Dekan/Direktur Program Pasca Sarjana/Ketua Lembaga</option>
                                    <option value="4">Pembantu Dekan</option>
                                    <option value="3">Ketua Jurusan/Ketua Prodi pada Universitas, Sekretaris Jurusan Universitas/kepala Laboratorium (Bengkel) Universitas</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">K</td>
                            <td colspan="3">Membimbing Dosen yang Mempunyai Jabatan Akademik lebih Rendah (Bagi Dosen Lektor Kepala ke Atas)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Berapa orangkah yang Anda bimbing sebagai pembimbing pencangkokan pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-K-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_k_no_1">
                                    <span class="input-group-addon btn-default">Orang</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Berapa orangkah yang Anda bimbing sebagai pembimbing reguler pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-K-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_k_no_2">
                                    <span class="input-group-addon btn-default">Orang</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">L</td>
                            <td colspan="3">Melaksanakan kegiatan detasering dan pencangkokan di luar institusi tempat berkerja setiap semester (bagi Dosen Lektor Kepala ke Atas)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Berapa orangkah yang menjadi target pada detasering yang Anda lakukan pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-L-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_l_no_1">
                                    <span class="input-group-addon btn-default">Orang</span>
                                </div>
                            </td>
                           <!--  <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Berapa orangkah yang menjadi target pada pencangkokan yang Anda lakukan pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="A-II-L-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_2_l_no_2">
                                    <span class="input-group-addon btn-default">Orang</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">M</td>
                            <td colspan="3">Melaksanakan pengambangan diri untuk meningkatkan kompetensi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Berapa lamakah waktu yang Anda gunakan dalam melaksanakan pengembangan diri untuk mengingkatkan kompetensi pada semester ini?</td>
                            <td colspan="2">
                                <select class="selectize" id="A-II-M" name="bag_2_m_no_1">
                                    <option value="0" selected>0 - 9 Jam</option>
                                    <option value="0.5">10 - 30 Jam</option>
                                    <option value="1">30 - 80 Jam</option>
                                    <option value="2">81 - 160 Jam</option>
                                    <option value="3">161 - 480 Jam</option>
                                    <option value="6">481 - 640 Jam</option>
                                    <option value="9">641 - 960 Jam</option>
                                    <option value="15">Lebih dari 960 Jam</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Perencanaan Unsur Penelitian</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-0">No</th>
                            <th class="col-md-9">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bold uppercase">
                            <td class="parentJudul">III</td>
                            <td colspan="3">Unsur Penelitian</td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">A</td>
                            <td colspan="3">Menghasilkan karya ilmiah sesuai dengan bidang ilmunya</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semseter ini, berapakah hasil penelitian/pemikiran Anda yang dipublikasikan dalam buku referensi?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-a-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_1">
                                    <span class="input-group-addon btn-default">Buku</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang dipublikasikan dalam monograf?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-a-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_2">
                                    <span class="input-group-addon btn-default">Monograf</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapakah hasil penelitian/pemikiran Anda dalam bentuk buku yang dipublikasikan dan berisi berbagai tulisan dari berbagai penulis internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-a-2-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_3">
                                    <span class="input-group-addon btn-default">Buku</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Pada semester ini, berapakah hasil penelitian/pemikiran Anda dalam bentuk buku yang dipublikasikan dan berisi berbagai tulisan dari berbagai penulis nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-a-2-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_4">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>5. Pada semester ini, berapakah hasil penelitian atau pemikiran Anda yang dipublikasikan dalam jurnal internasional bereputasi (terindeks pada database internasional bereputasi dan berfaktor dampak)?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-1-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_5">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>6. Pada semester ini, berapakah hasil penelitian atau pemikiran Anda yang dipublikasikan dalam jurnal internasional bereputasi yang terindeks pada database internasional bereputasi?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-1-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_6">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>7. Pada semseter ini, berapakah hasil penelitian atau pemikiran Anda yang dipublikasikan dalam jurnal internasional bereputasi yang terindeks pada database internasional diluar kategori 2?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-1-3" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_7">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>8. Pada semseter ini, berapakah hasil penelitian atau pemikiran Anda yang dipublikasikan dalam jurnal nasional terakreditasi Sinta 1 dan Sinta 2?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_8">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>9. Pada semester ini, berapakah hasil penelitian atau pemikiran Anda yang dibupublikasikan dalam jurnal nasional berbahasa Inggris atau bahasa resmi (PBB) yang terakreditasi Sinta 3 dan Sinta 4?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-2-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_9">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>10. Pada semester ini, berapakah hasil penelitian atau pemikiran Anda yang dibupublikasikan dalam jurnal nasional berbahasa Indonesia atau bahasa resmi (PBB) terakreditasi Sinta 5 dan Sinta 6?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-2-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_10">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>11. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang dipublikasikan dalam bentuk jurnal nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-3" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_11">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>12. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang dipublikasikan dalam bentuk jurnal ilmiah yang ditulis dalam Bahasa Resmi PBB namun tidak memenuhi syarat-syarat sebagai jurnal ilmiah Internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-b-3-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_12">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">B</td>
                            <td colspan="3">Hasil penelitian atau hasil pemikiran yang didesiminasikan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang didesiminasikan dan dipresentasikan secara oral dan dimuat dalam prosiding yang dipublilkasikan secara internasional terindex scimagojr dan scopus?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-1-a-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang didesiminasikan dan dipresentasikan secara oral dan dimuat dalam prosiding yang dipublilkasikan secara internasional Scopus, IEEE Explore, dan SPIE?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-1-a-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_2">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang didesiminasikan dan dipresentasikan secara oral dan dimuat dalam prosiding yang dipublilkasikan (ber ISSN/ISBN) secara internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-1-a-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_a_no_3">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang didesiminasikan dan dipresentasikan secara oral dan dimuat dalam prosiding yang dipublilkasikan (ber ISSN/ISBN) secara nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-1-b-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_4">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>5. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang didesiminasikan dan dimuat dalam prosiding yang dipublikasikan secara internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-2-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_5">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>6. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang didesiminasikan dan dimuat dalam prosiding yang dipublikasikan secara nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-2-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_6">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>7. Pada semester ini, berapakah hasil penelitian/ pemikiran Anda yang disajikan dalam seminar/simposium/lokakarya tetapi tidak dimuat dalam prosiding secara internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-1-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_7">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>8. Pada semester ini, berapakah hasil penelitian/ pemikiran Anda yang disajikan dalam seminar/simposium/lokakarya tetapi tidak dimuat dalam prosiding secara nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-1-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_8">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>9. Pada semester ini, berapakah hasil penelitian/ pemikiran Anda yang tidak disajikan dalam seminar/simposium/lokakarya, tetapi dimuat dalam prosiding secara internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-3-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_9">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>10. Pada semester ini, berapakah hasil penelitian/ pemikiran Anda yang tidak disajikan dalam seminar/simposium/lokakarya, tetapi dimuat dalam prosiding secara nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-c-3-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_10">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>11. Pada semester ini, berapakah hasil penelitian/pemikiran Anda yang disajikan dalam koran/majalah populer atau umum?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-1-d" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_b_no_11">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">C</td>
                            <td colspan="3">Hasil penelitian/pemikiran/kerjasama industri yang tidak dipublikasikan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Berapakah hasil penelitian/pemikiran/kerjasama industri Anda yang tidak dipublikasikan (tersimpan dalam perpustakaan) pada semester ini?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-A-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_c_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">D</td>
                            <td colspan="3">Menerjemahkan buku ilmiah yang diterbitkan (ber ISBN)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pada semester ini, berapakah buku ilmiah (ber ISBN) yang Anda terjemahkan/sudurkan?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-B" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_d_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">E</td>
                            <td colspan="3">Mengedit/menyunting karya ilmiah dalam bentuk buku yang diterbitkan (ber ISBN)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pada semester ini, berapakah karya ilmiah yang Anda edit/sunting dalam bentuk buku yang diterbitkan (ber ISBN)?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-C" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_e_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">F</td>
                            <td colspan="3">Membuat rancangan dan karya teknologi/seni yang dipatenkan secara nasional atau internasional</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini berapakah rancangan dan karya teknologi/seni Anda yang dipatenkan secara internasional (paling sedikit diakui oleh 4 negara)?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-D-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_f_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini berapakah rancangan dan karya teknologi/seni Anda yang dipatenkan secara nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-D-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_f_no_2">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">G</td>
                            <td colspan="3">Membuat rancangan dan karya teknologi yang tidak dipatenkan; rancangan dan karya seni monumental/seni pertunjukan; karya sastra</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapakah rancangan dan karya teknologi/seni monumental/seni pertunjukan/karya sastra Anda yang tidak dipatenkan di tingkat internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-E-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_g_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapakah rancangan dan karya teknologi/seni monumental/seni pertunjukan/karya sastra Anda yang tidak dipatenkan di tingkat nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-E-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_g_no_2">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapakah rancangan dan karya teknologi/seni monumental/seni pertunjukan/karya sastra Anda yang tidak dipatenkan di tingkat lokal?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-E-3" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_g_no_3">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">H</td>
                            <td colspan="3">Membuat rancangan dan karya seni/seni pertunjukan yang tidak mendapatkan HKI*)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pada semester ini, berapakah rancangan dan karya seni/seni pertunjukkan Anda yang tidak mendapatkan HKI?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="B-II-E-4" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_3_h_no_1">
                                    <span class="input-group-addon btn-default">Karya</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Perencanaan Unsur Pengabdian Masyarakat</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-0">No</th>
                            <th class="col-md-9">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bold uppercase">
                            <td class="parentJudul">IV</td>
                            <td colspan="3">Unsur Pengabdian Kepada Masyarakat</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Apakah semester ini Anda menduduki jabatan pimpinan pada lembaga pemerintahan/pejabat negara yang harus dibebaskan dari jabatan organiknya tiap semester?</td>
                            <td>
                                <select class="selectize" id="C-I" name="bag_4_a_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini berapa programkah Anda melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyarakat/industri?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-II" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_2">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan dalam satu semester atau lebih di tingkat internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-1-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_3">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan dalam satu semester atau lebih di tingkat nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-1-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_4">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>5. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan dalam satu semester atau lebih di tingkat lokal?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-1-c" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_5">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>6. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan kurang dari satu semester (minimal 1 bulan) di tingkat internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-2-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_6">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>7. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan kurang dari satu semester (minimal 1 bulan) di tingkat nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-2-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_7">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>8. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan kurang dari satu semester (minimal 1 bulan) di tingkat lokal?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-2-c" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_8">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>9. Pada semester ini, berapa programkah Anda memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan kurang dari satu semester (minimal 1 bulan) di tingkat insidental??</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-III-2-d" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_9">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>10. Pada semester ini, berapa programkah Anda memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan berdasarkan bidang keahlian?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-IV-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_10">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>11. Pada semester ini, berapa programkah Anda memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan berdasarkan penugasan lembaga perguruan tinggi?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-IV-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_11">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>12. Pada semester ini, berapa programkah Anda memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan berdasarkan fungsi/jabatan?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-IV-c" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_12">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>13. Pada semester ini, berapa programkah Anda membuat/menulis karya pengabdian kepada masyarakat yang tidak dipublikasikan?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="C-V" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_4_a_no_13">
                                    <span class="input-group-addon btn-default">Program</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Perencanaan Unsur Penunjang</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-0">No</th>
                            <th class="col-md-9">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bold uppercase">
                            <td class="parentJudul">V</td>
                            <td colspan="3">Unsur Penunjang</td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">A</td>
                            <td colspan="3">Menjadi anggota dalam suatu panitia/badan pada perguruan tinggi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Apakah semester ini Anda menjadi Ketua/Wakil Ketua merangkap Anggota dalam suatu Panitia/Badan pada Perguruan Tinggi</td>
                            <td>
                                <select class="selectize" id="D-I-a" name="bag_5_a_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Apakah semester ini Anda menjadi Anggota dalam suatu Panitia/Badan pada Perguruan Tinggi</td>
                            <td>
                                <select class="selectize" id="D-I-b" name="bag_5_a_no_2">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">B</td>
                            <td colspan="3">Menjadi anggota dalam suatu panitia/badan pada lembaga pemerintah</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapa kepanitiaankah Anda menjadi Ketua/Wakil Ketua pada lembaga pemerintah pusat?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-II-a-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_5_b_no_1">
                                    <span class="input-group-addon btn-default" title="Kepanitiaan">Kepanitia..</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapa kepanitiaankah Anda menjadi Anggota pada lembaga pemerintah pusat?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-II-a-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="bag_5_b_no_2">
                                    <span class="input-group-addon btn-default" title="Kepanitiaan">Kepanitia..</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapa kepanitiaankah Anda menjadi Ketua/Wakil Ketua pada lembaga pemerintah daerah?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-II-b-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_b_no_3">
                                    <span class="input-group-addon btn-default" title="Kepanitiaan">Kepanitia..</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Pada semester ini, berapa kepanitiaankah Anda menjadi Anggota pada lembaga pemerintah daerah?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-II-b-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_b_no_4">
                                    <span class="input-group-addon btn-default" title="Kepanitiaan">Kepanitia..</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">C</td>
                            <td colspan="3">Menjadi anggota organisasi profesi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Apakah semester ini Anda diangkat menjadi pengurus organisasi profesi tingkat internasional?</td>
                            <td>
                                <select class="selectize" id="D-III-a-1" name="bag_5_c_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Apakah semester ini Anda diangkat menjadi anggota organisasi profesi (atas permintaan) di tingkat internasional dan diperiode kepenguruan baru?</td>
                            <td>
                                <select class="selectize" id="D-III-a-2" name="bag_5_c_no_2">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Apakah semester ini Anda diangkat menjadi anggota organisasi profesi (bukan atas permintaan) di tingkat internasional dan diperiode kepenguruan baru?</td>
                            <td>
                                <select class="selectize" id="D-III-a-3" name="bag_5_c_no_3">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Apakah semester ini Anda diangkat menjadi pengurus organisasi profesi tingkat nasional?</td>
                            <td>
                                <select class="selectize" id="D-III-b-1" name="bag_5_c_no_4">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>5. Apakah semester ini Anda diangkat menjadi anggota (atas permintaan) organisasi profesi tingkat nasional (diperiode kepengurusan baru)?</td>
                            <td>
                                <select class="selectize" id="D-III-b-2" name="bag_5_c_no_5">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>6. Apakah semester ini Anda diangkat menjadi anggota organisasi profesi tingkat nasional (diperode kepengurusan baru)?</td>
                            <td>
                                <select class="selectize" id="D-III-b-3" name="bag_5_c_no_6">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">D</td>
                            <td colspan="3">Mewakili perguruan tinggi/lembaga pemerintah duduk dalam panitia antar lembaga</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pada semester ini, berapa kepanitiaankah Anda mewakili perguruan tinggi/lembaga pemerintah duduk dalam penitia antar lembaga?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-IV" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_d_no_1">
                                    <span class="input-group-addon btn-default" title="Kepanitiaan">Kepanitia..</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">E</td>
                            <td colspan="3">Menjadi anggota delegasi nasional ke pertemuan internasional</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapa kegiatankah Anda menjadi anggota delegasi nasional ke pertemuan internasional sebagai ketua delegasi?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-V-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_e_no_1">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapa kegiatankah Anda menjadi anggota delegasi nasional ke pertemuan internasional sebagai anggota?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-V-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_e_no_2">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">F</td>
                            <td colspan="3">Berperan serta aktif dalam pengelolaan jurnal ilmiah</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini apakah anda berperan sebagai editor/dewan penyunting/dewan redaksi jurnal internasional?</td>
                            <td>
                                <select class="selectize" id="D-VI-a" name="bag_5_f_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini apakah anda berperan sebagai editor/dewan penyunting/dewan redaksi jurnal nasional?</td>
                            <td>
                                <select class="selectize" id="D-VI-b" name="bag_5_f_no_2">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">G</td>
                            <td colspan="3">Berperan serta aktif dalam pertemuan ilmiah</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapa kegiatankah Anda berperan serta aktif dalam pertemuan ilmiah tingkat internasional/nasional/regional sebagai ketua?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VII-a-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_g_no_1">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapa kegiatankah Anda berperan serta aktif dalam pertemuan ilmiah tingkat internasional/nasional/regional sebagai anggota?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VII-a-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_g_no_2">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapa kegiatankah Anda berperan serta aktif dalam pertemuan ilmiah di lingkungan perguruan tinggi sebagai ketua?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VII-b-1" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_g_no_3">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Pada semester ini, berapa kegiatankah Anda berperan serta aktif dalam pertemuan ilmiah di lingkungan perguruan tinggi sebagai anggota?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VII-b-2" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_g_no_4">
                                    <span class="input-group-addon btn-default">Kegiatan</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">H</td>
                            <td colspan="3">Mendapatkan tanda jasa/penghargaan</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Apakah pada semester ini Anda mendapatkan penghargaan/tanda jasa Satya lencana 30 tahun?</td>
                            <td>
                                <select class="selectize" id="D-VIII-a" name="bag_5_h_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Apakah pada semester ini Anda mendapatkan penghargaan/tanda jasa Satya lencana 20 tahun?</td>
                            <td>
                                <select class="selectize" id="D-VIII-b" name="bag_5_h_no_2">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Apakah pada semester ini Anda mendapatkan penghargaan/tanda jasa Satya lencana 30 tahun?</td>
                            <td>
                                <select class="selectize" id="D-VIII-c" name="bag_5_h_no_3">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>4. Pada semester ini, berapa tanda jasakah (atau penghargaan) tingkat internasional yang Anda peroleh?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VIII-d" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_h_no_4">
                                    <span class="input-group-addon btn-default">T. Jasa</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>5. Pada semester ini, berapa tanda jasakah (atau penghargaan) tingkat nasional yang Anda peroleh?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VIII-e" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_h_no_5">
                                    <span class="input-group-addon btn-default">T. Jasa</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>6. Pada semester ini, berapa tanda jasakah (atau penghargaan) tingkat daerah/lokal yang Anda peroleh?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-VIII-f" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_h_no_6">
                                    <span class="input-group-addon btn-default">T. Jasa</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">I</td>
                            <td colspan="3">Menulis buku pelajaran SLTA ke bawah yang diterbitkan dan diedarkan secara nasional</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapa buku pelajarankah (buku SMTA/setingkat) yang Anda tulis (yang diterbitkan dan diedarkan secara nasional)?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-IX-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_i_no_1">
                                    <span class="input-group-addon btn-default">Buku</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapa buku pelajarankah (buku SMTP/setingkat) yang Anda tulis (yang diterbitkan dan diedarkan secara nasional)?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-IX-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_i_no_2">
                                    <span class="input-group-addon btn-default">Buku</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapa buku pelajarankah (buku SD/setingkat) yang Anda tulis (yang diterbitkan dan diedarkan secara nasional)?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-IX-c" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_i_no_3">
                                    <span class="input-group-addon btn-default">Buku</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">J</td>
                            <td colspan="3">Mempunyai prestasi di bidang olahraga/humaniora</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1. Pada semester ini, berapa medali/piagamkah yang Anda peroleh sebagai bentuk penghargaan atas prestasi Anda di bidang olahraga/humaniora tingkat internasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-X-a" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_j_no_1">
                                    <span class="input-group-addon btn-default" title="Medali/Piagam">Medali/...</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>2. Pada semester ini, berapa medali/piagamkah yang Anda peroleh sebagai bentuk penghargaan atas prestasi Anda di bidang olahraga/humaniora tingkat nasional?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-X-b" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_j_no_2">
                                    <span class="input-group-addon btn-default" title="Medali/Piagam">Medali/...</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td>3. Pada semester ini, berapa medali/piagamkah yang Anda peroleh sebagai bentuk penghargaan atas prestasi Anda di bidang olahraga/humaniora tingkat daerah/lokal?</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" id="D-X-c" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlengh="3" name="bag_5_j_no_3">
                                    <span class="input-group-addon btn-default" title="Medali/Piagam">Medali/...</span>
                                </div>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                        <tr class="bold uppercase">
                            <td class="parentJudul">K</td>
                            <td colspan="3">Keanggotaan dalam tim penilai jabatan akademik dosen</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Apakah pada semester ini Anda ikut masuk kedalam kenggotaan dalam tim penilai jabatan akademik dosen?</td>
                            <td>
                                <select class="selectize" id="D-XI" name="bag_5_k_no_1">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            <!-- <td>
                                #PTS
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 right">
                     <button class="btn btn-md btn-success" type="submit">Simpan Perencanaan</button>
                </div>
                </form>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".selectize").selectize();
    function onOffQue(state,$classID) {
        if(state==0) {
            $("."+$classID).attr("disabled","disabled");
            console.log("matikan");
        } else
            $("."+$classID).removeAttr("disabled");
    }
</script>
@endsection

@section("link")
<script type="text/javascript" src="{{asset('assets/validasi/inputan.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/validasi/pesan.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/selectize.css')}}">
<script type="text/javascript" src="{{asset('assets/js/selectize.js')}}"></script>
@endsection

@section("script")
    @include("layouts.notifikasi")
@endsection