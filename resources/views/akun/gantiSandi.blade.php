@extends("layouts.app")

@section("konten")
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Ganti Kata Sandi</h2>
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
                            <td class="col-md-4">Kata Sandi Saat Ini</td>
                            <td class="col-md-8"><input placeholder="********" class="form-control" type="password" id="sandi"></td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Kata Sandi Baru</td>
                            <td class="col-md-8"><input placeholder="********" class="form-control" type="password" id="sandiBaru"></td>
                        </tr>
                        <tr>
                            <td class="col-md-4">Ketik Ulang Sandi Baru</td>
                            <td class="col-md-8"><input placeholder="********" class="form-control" type="password" id="sandiBaruKonfirmasi"></td>
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

    function update() {
        $sandi     = $("#sandi").val();
        $sandiBaru = $("#sandiBaru").val();
        $konfSandi = $("#sandiBaruKonfirmasi").val();
        $token     = $(".token input").val();
        $("#myModal").modal("hide");
        if($sandi=="")
            notif("error","Kata sandi belum diinput!"); else
        if($sandiBaru=="")
            notif("error","Kata sandi baru belum diinput!"); else
        if($konfSandi=="")
            notif("error","Konfirmasi kata sandi baru belum diinput!"); else
        if($sandiBaru != $konfSandi)
            notif("error","Konfirmasi kata sandi salah!"); else
        if($sandiBaru.length<6)
            notif("error","Kata sandi baru terlalu lemah!"); else
        {
            $.ajax({
                url    : "{{Route('api')}}/profil/update/sandi",
                method : "POST",
                data   : {
                    "_token"    : $token,
                    "sandi"     : $sandi,
                    "sandiBaru" : $sandiBaru,
                    "konfSandi" : $konfSandi
                },
            }).then(function(res){
                if(res=="notMatch")
                    notif("error","Kata sandi lama yang Anda inputkan salah!"); else
                if(res=="success")
                    notif("success","Kata sandi berhasil diganti!"); else
                    notif("error","Perubahan kata sandi tidak dapat disimpan!");
            });
        };
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