@extends("layouts.auth")

@section("konten")
<div class="loginwrapper">
    <div class="loginone">
        <header>
            <h1 class="white margin-3">Register Panel</h1>
            <p>Silahkan isi form pendaftaran berikut</p>
        </header>
        <form action="{{Route('register')}}" method="POST" onsubmit="return validasi(event)">
            {{csrf_field()}}
            <div class="username">
                <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required>
                <i class="glyphicon glyphicon-envelope"></i>
            </div>
            <div class="password">
                <input type="password" name="password" class="form-control" placeholder="Kata Sandi" minlength="6" required>
                <i class="glyphicon glyphicon-lock"></i>
            </div>
            <div class="inputan">
                <input type="date" name="tglLahir" title="Tanggal Lahir" value="{{ old('tglLahir') }}" required>
                <i class="glyphicon glyphicon-calendar"></i>
            </div>
            <div class="inputan">
                <select class="form-control select-login" name="jabatan" required>
                    <option disabled selected value="">Pilih Jabatan Fungsional</option>
                    @foreach($jabatan as $data)
                    <option value="{{Crypt::encrypt($data->id_jab)}}">{{$data->jabatan}} ({{$data->jenjang}}, {{$data->golongan}})</option>
                    @endforeach
                </select>
                <i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="inputan">
                <select class="form-control select-login" name="pendidikan" required>
                    <option disabled selected value="">Pilih Jenjang Pendidikan</option>
                    @foreach($pendidikan as $data)
                    <option value="{{Crypt::encrypt($data->id_pend)}}">{{$data->pendidikan}}</option>
                    @endforeach
                </select>
                <i class="glyphicon glyphicon-signal"></i>
            </div>
            <div class="inputan">
                <input type="date" name="tglJadi" title="Tanggal Menjadi Dosen" value="{{ old('tglJadi') }}" required>
                <i class="glyphicon glyphicon-calendar"></i>
            </div>
            <div class="custom-radio-checkbox">
                <input type="radio" class="bluecheckradios" value="1" name="serdos" id="serdos" checked>
                <label class="margin-right-25" for="serdos">Serdos</label>
                <input type="radio" class="bluecheckradios" value="0" name="serdos" id="belumSerdor">
                <label for="belumSerdor">Belum Serdos</label>
            </div>
            <script>
                $(document).ready(function(){
                  $('.bluecheckradios').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                    radioClass: 'iradio_flat-blue',
                    increaseArea: '20%' // optional
                  });
                });     
            </script>
            <input type="submit" class="btn btn-primary style2" value="Buat Akun">
        </form>
        <footer>
            <a href="{{Route('password.request')}}" class="forgot pull-left">Lupa Sandi?</a>
            <a href="{{Route('login')}}" class="register pull-right">Login Sekarang</a>
            <div class="clear"></div>
        </footer>
    </div>
</div>
<script type="text/javascript" src="{{asset('assets/validasi/tanggal.min.js')}}"></script>
@endsection