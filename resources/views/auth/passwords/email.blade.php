@extends("layouts.auth")

@section("konten")
<div class="loginwrapper">
    <div class="loginone">
        <header>
            <h1 class="white margin-3">Reset Kata Sandi</h1>
            <p>Silahkan masukkan alamat email Anda!</p>
        </header>
        <form action="{{Route('password.email')}}" method="POST">
            {{csrf_field()}}
            <div class="inputan">
                <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required>
                <i class="glyphicon glyphicon-envelope"></i>
            </div>
            <input type="submit" class="btn btn-primary style2" value="Kirim Link Reset Sandi">
        </form>
        <footer>
            <a href="{{Route('login')}}" class="forgot pull-left">Login Sekarang</a>
            <a href="{{Route('register')}}" class="register pull-right">Daftar Sekarang</a>
            <div class="clear"></div>
        </footer>
    </div>
</div>
@endsection