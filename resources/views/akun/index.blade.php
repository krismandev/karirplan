@extends("layouts.app")

@section("konten")
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Akun Saya</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-4">Parameter</th>
                            <th class="col-md-8">Inputan/Isian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-4">Alamat Email</td>
                            <td class="col-md-8"><input placeholder="Contoh: nama@sevicemail.com" class="form-control" type="text" id="email" value="{{Auth::user()->email}}"></td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Tanggal Lahir</td>
                            <td class="col-md-8"><input class="form-control" type="date" id="tglLahir" value="{{Auth::user()->tglLahir}}"></td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Pendidikan Saat Mendaftar Sistem</td>
                            <td class="col-md-8">
                                <select id="pendidikan">
                                    @foreach($pendidikan as $data)
                                    @if($data->id_pend!=Auth::user()->id_pend)
                                    <option value="{{Crypt::encrypt($data->id_pend)}}">{{$data->pendidikan}}</option>
                                    @else
                                    <option value="{{Crypt::encrypt($data->id_pend)}}" selected>{{$data->pendidikan}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Jabatan Saat Mendaftar Sistem</td>
                            <td class="col-md-8">
                                <select id="jabatan">
                                    @foreach($jabatan as $data)
                                    @if($data->id_jab!=Auth::user()->id_jab)
                                    <option value="{{Crypt::encrypt($data->id_jab)}}">{{$data->jabatan}} ({{$data->jenjang}}, {{$data->golongan}})</option>
                                    @else
                                    <option value="{{Crypt::encrypt($data->id_jab)}}" selected>{{$data->jabatan}} ({{$data->jenjang}}, {{$data->golongan}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Tanggal Menduduki Jabatan Diatas</td>
                            <td class="col-md-8"><input class="form-control" type="date" id="tglJadi" value="{{Auth::user()->tglJadi}}"></td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Status Sertifikasi Dosen</td>
                            <td class="col-md-8">
                                <div class="onoffswitch android">
                                    @if(Auth::user()->serdos)
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="serdos" checked onchange="serdosChange()">
                                    @else
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="serdos" onchange="serdosChange()">
                                    @endif
                                    <label class="onoffswitch-label" for="serdos">
                                        <div class="onoffswitch-inner">
                                            <div class="onoffswitch-active"><div class="onoffswitch-switch">SDH</div></div>
                                            <div class="onoffswitch-inactive"><div class="onoffswitch-switch">BLM</div></div>
                                        </div>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="col-xs-12 right">
    <button class="btn btn-md btn-primary" onclick="update()">Simpan Perubahan</button>
</div>
<div class="token">{{csrf_field()}}</div>
<!-- ========================== Batas Konten ============================= -->
<script type="text/javascript">
    $("#pendidikan").selectize();
    $("#jabatan").selectize();

    $serdos = "{{Auth::user()->serdos}}";

    function serdosChange() {
        if($serdos==0) $serdos=1; else $serdos=0;
    }

    function update() {
        var msg = "<h3 style='margin-top:0px;color:white'>Yakin akan mengubah informasi profil Anda?</h3><span class='black italic'>Pengubahan informasi awal Anda akan menyebaban peresetan terhadap seluruh perencanaan yang telah Anda buat!</span><br><br><button class='btn btn-warning style2' onclick='update_exe()'>Tetap Ubah</button>";
        update_notif("errorbox");
        $(".modal-title").html("Perhatian!!");
        $("#modal-msg").html(msg);
        $("#myModal").modal("show");
    };

    function update_exe() {
        validasi_tgl();
    }

    function validasi_tgl() {
        // Sistem Validasi Tanggal //
        $cekTglLahir = new Date($("#tglLahir").val());
        $cekTglJadi = new Date($("#tglJadi").val());

        if($cekTglJadi.getFullYear()>getThisYear()) {
            notif("error","Tahun pertama kali memperoleh jabatan tidak valid!");
        } else
        if(getThisYear()==$cekTglJadi.getFullYear()) {
            if( $cekTglJadi.getMonth() > getThisMonth() ) {
                notif("error","Tanggal pertama kali memperoleh jabatan tidak valid!");
            } else
            if( $cekTglJadi.getMonth() == getThisMonth()) {
                if($cekTglJadi.getDate()>getThisDate()) {
                    notif("error","Tanggal pertama kali memperoleh jabatan tidak valid!");
                };
            };
            // Validasi Tanggal Lahir //
            if(getThisYear()-$cekTglLahir.getFullYear() >=20) { //Jika umurnya >20 thn;
                upload_data();
            } else {
                notif("error","Tanggal lahir yang diinputkan terlalu dini!");
            };
        };
    }

    function upload_data() {
        $email    = $("#email").val();
        $tglLahir = $("#tglLahir").val();
        $lastPend = $("#pendidikan").val();
        $jabatan  = $("#jabatan").val();
        $tglJadi  = $("#tglJadi").val();
        $token    = $(".token input").val();
        /*console.log({
            "email"    : $email,
            "tglLahir" : $tglLahir,
            "lastPend" : $lastPend,
            "jabatan"  : $jabatan,
            "tglJadi"  : $tglJadi,
            "serdos"   : $serdos
        });*/
        $("#myModal").modal("hide");
        $.ajax({
                url    : "{{Route('api')}}/profil/update",
                method : "POST",
                data   : {
                    "_token"   : $token,
                    "email"    : $email,
                    "tglLahir" : $tglLahir,
                    "lastPend" : $lastPend,
                    "jabatan"  : $jabatan,
                    "tglJadi"  : $tglJadi,
                    "serdos"   : $serdos
                },
            }).then(function(res){
                if(res=="success") {
                    notif("success","Perubahan profil Anda berhasil disimpan!");
                } else {
                    notif("error","Perubahan pada profil Anda tidak dapat disimpan pada sistem!");
                }
            });
    }
</script>
@endsection

@section("link")
<script type="text/javascript" src="{{asset('assets/validasi/inputan.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/validasi/pesan.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/selectize.css')}}">
<script type="text/javascript" src="{{asset('assets/js/selectize.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/validasi/tanggal.min.js')}}"></script>
@endsection

@section("script")
    @include("layouts.notifikasi")
@endsection