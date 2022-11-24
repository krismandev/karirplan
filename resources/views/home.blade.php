@extends("layouts.app")
@section("konten")
<div class="content-section">
    <div class="container-liquid">
        
        @foreach($data as $item)
        <div class="row">
            <div class="col-xs-2">
                <div class="stat-box colorsix">
                    <i class="author">&nbsp;</i>
                    <h4>Nama</h4>
                    <h4>{{$item->nama_pegawai}}</h4>
                </div>
            </div>
            <div class="col-xs-2        ">
                <div class="stat-box colortwo">
                    <i class="author">&nbsp;</i>
                    <h4>NIP</h4>
                    <h4>{{$item->nip}}</h4>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="stat-box colorone">
                    <i class="author">&nbsp;</i>
                    <h4>Tanggal Lahir</h4>
                    <h4>{{$item->tgl_lahir}}</h4>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="stat-box colorfive">
                    <i class="author">&nbsp;</i>
                    <h4>Pendidikan</h4>
                    <h4>{{$item->nama_jenjang_pendidikan}}</h4>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="stat-box colorsix">
                    <i class="author">&nbsp;</i>
                    <h4>Golongan</h4>
                    <h4>{{$item->kode_golongan}}</h4>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="stat-box colorsix">
                    <i class="author">&nbsp;</i>
                    <h4>Pangkat</h4>
                    <h4>{{$item->nama_pangkat}}</h4>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="stat-box colorseven">
                    <i class="author">&nbsp;</i>
                    <h4>Jabatan Fungsional</h4>
                    <h4>{{$item->nama_jabfung}}</h4>
                </div>
            </div>
             @php
                if(isset($jabfung_semen)){
                 echo "$jabfung_semen";
            }
             @endphp
        </div>
        @endforeach
        <!-- Row End -->
        <div style="margin-top: 20px;">
            <a href="/plan/input">
                 <button type="button" class="btn btn-info">Tambah Planing</button>
            </a>
           
        </div>
        
    </div>
</div>
@endsection

@section("script")
<script type="text/javascript" src="assets/js/raphael-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/morris-0.4.1.min.js"></script>
@endsection