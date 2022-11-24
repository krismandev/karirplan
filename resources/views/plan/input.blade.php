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
                            <th class="col-md-8">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Bukti</th>
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
                        @foreach($A_I_A as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr class="bold uppercase">
                            <td class="parentJudul">II</td>
                            <td colspan="3">Unsur Pelaksanaan Pendidikan</td>
                        </tr>
                        <tr class="bold uppercase">
                            <td class="subJudul">A</td>
                            <td colspan="3">melaksanakan perkuliahan/tutorial/perkuliahan, praktikum, membimbing, menguji, serta menyelenggarakan pendidikan di laboratorium, praktik keguruan, bengkel/sudio/kebun percobaan/teknologi pengajaran dan praktik lapangan</td>
                        </tr>
                        @foreach($A_II_A as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                                <div class="input-group">
                                    <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bold uppercase">
                            <td class="subJudul">B</td>
                            <td colspan="3">Membimbing seminar mahasiswa (setiap semester)</td>
                        </tr>
                        @foreach($A_II_B as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                                <div class="input-group">
                                    <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bold uppercase">
                            <td class="subJudul">C</td>
                            <td colspan="3">Membimbing KKN, PKN, dan PKL (Setiap Semester)</td>
                        </tr>
                        @foreach($A_II_C as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                                <div class="input-group">
                                    <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bold uppercase">
                            <td class="subJudul">D I</td>
                            <td colspan="3">Membimbing dalam menghasilkan disertasi, tersis, skripsi, dan laporan akhir studi</td>
                        </tr>
                        @foreach($A_II_D_1 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bold uppercase">
                            <td class="subJudul">D II</td>
                            <td colspan="3">Membimbing dalam menghasilkan disertasi, tersis, skripsi, dan laporan akhir studi</td>
                        </tr>
                        @foreach($A_II_D_2 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                       
                        <tr class="bold uppercase">
                            <td class="subJudul">E</td>
                            <td colspan="3">Bertugas sebagai penguji pada ujian akhir/profesi</td>
                        </tr>
                        @foreach($A_II_E as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                       
                        <tr class="bold uppercase">
                            <td class="subJudul">F</td>
                            <td colspan="3">Membina kegiatan mahasiswa dibidang akademik dan kemahasiswaan</td>
                        </tr>

                        @foreach($A_II_F as $item) 
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="subJudul">G</td>
                            <td colspan="3">Mengembangkan program kuliah yang mempunyai nilai kebagharuan metode atau substansi</td>
                        </tr>

                        @foreach($A_II_G as $item) 
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="subJudul">H</td>
                            <td colspan="3">Mengembangkan bahan pengajaran/bahan kuliah yang memiliki nilai kebaharuan</td>
                        </tr>
                        @foreach($A_II_H as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr class="bold uppercase">
                            <td class="subJudul">I</td>
                            <td colspan="3">Menyampaikan orasi ilmiah di tingkat perguruan tinggi</td>
                        </tr>
                        @foreach($A_II_I as $item) 
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="subJudul">J</td>
                            <td colspan="3">Menduduki jabatan pimpinan perguruan tinggi</td>
                        </tr>
                        @foreach($A_II_J as $item) 
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <!-- harus ambil dari db -->
                                    <option value="0" selected>Tidak Ada</option>
                                    <option value="6">Rektor</option>
                                    <option value="5">Wakil Rektor/Dekan/Direktur Program Pasca Sarjana/Ketua Lembaga</option>
                                    <option value="4">Pembantu Dekan</option>
                                    <option value="3">Ketua Jurusan/Ketua Prodi pada Universitas, Sekretaris Jurusan Universitas/kepala Laboratorium (Bengkel) Universitas</option>
                                </select>
                            </td>
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="subJudul">K</td>
                            <td colspan="3">Membimbing Dosen yang Mempunyai Jabatan Akademik lebih Rendah (Bagi Dosen Lektor Kepala ke Atas)</td>
                        </tr>

                        @foreach($A_II_K as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr class="bold uppercase">
                            <td class="subJudul">L</td>
                            <td colspan="3">Melaksanakan kegiatan detasering dan pencangkokan di luar institusi tempat berkerja setiap semester (bagi Dosen Lektor Kepala ke Atas)</td>
                        </tr>
                        @foreach($A_II_L as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                       
                        
                        <tr class="bold uppercase">
                            <td class="subJudul">M</td>
                            <td colspan="3">Melaksanakan pengambangan diri untuk meningkatkan kompetensi</td>
                        </tr>
                        @foreach($A_II_M as $item) 
                        <tr>
                            <td></td>
                            <td>{{$item->pertanyaan}}</td>
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
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
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
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
                            <th class="col-md-8">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Bukti</th>
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

                        @foreach($B_I_A_1 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">B</td>
                            <td colspan="3">Hasil penelitian atau hasil pemikiran yang didesiminasikan</td>
                        </tr>
                        
                        @foreach($B_I_A_2 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr class="bold uppercase">
                            <td class="parentJudul">C</td>
                            <td colspan="3">Hasil penelitian/pemikiran/kerjasama industri yang tidak dipublikasikan</td>
                        </tr>

                        @foreach($B_I_A_3 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">D</td>
                            <td colspan="3">Menerjemahkan buku ilmiah yang diterbitkan (ber ISBN)</td>
                        </tr>

                        @foreach($B_I_B_1 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">E</td>
                            <td colspan="3">Mengedit/menyunting karya ilmiah dalam bentuk buku yang diterbitkan (ber ISBN)</td>
                        </tr>

                        @foreach($B_I_B_2 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">F</td>
                            <td colspan="3">Membuat rancangan dan karya teknologi/seni yang dipatenkan secara nasional atau internasional</td>
                        </tr>

                        @foreach($B_I_B_3 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">G</td>
                            <td colspan="3">Membuat rancangan dan karya teknologi yang tidak dipatenkan; rancangan dan karya seni monumental/seni pertunjukan; karya sastra</td>
                        </tr>

                        @foreach($B_I_B_4 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                       @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">H</td>
                            <td colspan="3">Membuat rancangan dan karya seni/seni pertunjukan yang tidak mendapatkan HKI*)</td>
                        </tr>

                        @foreach($B_I_B_5 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

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
                            <th class="col-md-8">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bold uppercase">
                            <td class="parentJudul">IV</td>
                            <td colspan="3">Unsur Pengabdian Kepada Masyarakat</td>
                        </tr>

                        <tr class="bold uppercase">
                            <td class="parentJudul">A</td>
                            <td colspan="3">Menduduki jabatan pimpinan pada lembaga pemerintahan/pejabat negara yang harus dibebaskan dari jabatan organiknya tiap semester?</td>
                        </tr>

                        @foreach($C_I_A as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">B</td>
                            <td colspan="3">Melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyarakat/industri?</td>
                        </tr>

                        @foreach($C_I_B as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">C I</td>
                            <td colspan="3">Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan dalam satu semester atau lebih di tingkat internasional?</td>
                        </tr>

                        @foreach($C_I_C_1 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">C II</td>
                            <td colspan="3">Memberi latihan/penyuluhan/penataran/ceramah pada masyarakat, terjadwal/terprogram yang dilaksanakan dalam satu semester (minimal 1 bulan) di tingkat internasional?</td>
                        </tr>

                        @foreach($C_I_C_2 as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">D</td>
                            <td colspan="3">Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan</td>
                        </tr>

                        @foreach($C_I_D as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">E</td>
                            <td colspan="3">Membuat/menulis karya pengabdian kepada masyarakat yang tidak dipublikasikan</td>
                        </tr>

                        @foreach($C_I_E as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">F</td>
                            <td colspan="3">Hasil kegiatan pengabdiian kepada masyarakat yang dipublikasikan di sebuah berkala/jumal pengabdian kepada masyarakat atau teknologi tepat guna merupakan diseminasi dari luaran Program kegiatan pengabdian kepada masyarakat</td>
                        </tr>

                        @foreach($C_I_F as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">G</td>
                            <td colspan="3">Berperan serta aktif dalam pengelolaan jumal ilmiah</td>
                        </tr>

                        @foreach($C_I_G as $item) 
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
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
                            <th class="col-md-8">Pertanyaan</th>
                            <th class="col-md-2">Jawaban</th>
                            <th class="col-md-2">Bukti</th>
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
                        @foreach($D_I_A as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                            
                        </tr>
                       @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">B I</td>
                            <td colspan="3">Menjadi anggota dalam suatu panitia/badan pada lembaga pemerintah pusat</td>
                        </tr>
                        @foreach($D_I_B_1 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bold uppercase">
                            <td class="parentJudul">B II</td>
                            <td colspan="3">Menjadi anggota dalam suatu panitia/badan pada lembaga pemerintah daerah</td>
                        </tr>
                        @foreach($D_I_B_2 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                      
                        <tr class="bold uppercase">
                            <td class="parentJudul">C I</td>
                            <td colspan="3">Menjadi anggota organisasi profesi tingkat internasional</td>
                        </tr>
                        @foreach($D_I_C_1 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">C II</td>
                            <td colspan="3">Menjadi anggota organisasi profesi tingkat Nasional</td>
                        </tr>
                        @foreach($D_I_C_2 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                       
                        <tr class="bold uppercase">
                            <td class="parentJudul">D</td>
                            <td colspan="3">Mewakili perguruan tinggi/lembaga pemerintah duduk dalam panitia antar lembaga</td>
                        </tr>

                        @foreach($D_I_D as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">E</td>
                            <td colspan="3">Menjadi anggota delegasi nasional ke pertemuan internasional</td>
                        </tr>
                        
                        @foreach($D_I_E as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                      
                        <tr class="bold uppercase">
                            <td class="parentJudul">F I</td>
                            <td colspan="3">Berperan serta aktif dalam pertemuan ilmiah tingkat internasional/nasional/regional</td>
                        </tr>
                        
                        @foreach($D_I_F_1 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">F 2</td>
                            <td colspan="3">Berperan serta aktif dalam pertemuan ilmiah tingkat perguruan tinggi</td>
                        </tr>
                        
                        @foreach($D_I_F_2 as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                       

                        <tr class="bold uppercase">
                            <td class="parentJudul">G</td>
                            <td colspan="3">Mendapatkan tanda jasa/penghargaan</td>
                        </tr>
                       
                        @foreach($D_I_G as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr class="bold uppercase">
                            <td class="parentJudul">H</td>
                            <td colspan="3">Menulis buku pelajaran SLTA ke bawah yang diterbitkan dan diedarkan secara nasional</td>
                        </tr>
                        
                        @foreach($D_I_H as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">I</td>
                            <td colspan="3">Mempunyai prestasi di bidang olahraga / Humaniora</td>
                        </tr>
                        @foreach($D_I_I as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bold uppercase">
                            <td class="parentJudul">J</td>
                            <td colspan="3">Keanggotaan dalam tim penilai jabatan akademik dosen</td>
                        </tr>
                       
                        @foreach($D_I_J as $item)
                        <tr>
                            <td></td>
                            <td>{{$loop->iteration}}. {{$item->pertanyaan}}</td>
                            @if($item->jenis == 1)
                            <td>
                                <select class="selectize" id="{{$item->kode}}" name="{{$item->kode}}">
                                    <option value="1">Ya</option>
                                    <option value="0" selected>Tidak</option>
                                </select>
                            </td>
                            @elseif($item->jenis == 2)
                            <td>
                                <div class="input-group">
                                    <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                    <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                </div>
                            </td>
                            @endif
                            <td>
                            <div class="input-group">
                                <input class="form-control" type="file" id="formFile" name="bukti_{{$item->kode}}">
                            </div>
                            </td>
                        </tr>
                        @endforeach

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