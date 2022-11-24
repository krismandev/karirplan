@extends("layouts.auth")

@section("konten")
<div class="loginwrapper">
    <div class="loginone">
        <header>
            <h1 class="white margin-3">Reset Kata Sandi</h1>
            <p>Silahkan masukkan email dan sandi baru Anda!</p>
        </header>
        <form action="{{Route('password.request')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="inputan">
                <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required>
                <i class="glyphicon glyphicon-envelope"></i>
            </div>
            <div class="password">
                <input type="password" name="password" class="form-control" placeholder="Kata Sandi Baru" minlength="6" required>
                <i class="glyphicon glyphicon-lock"></i>
            </div>
            <div class="password">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik Ulang Sandi Baru" minlength="6" required>
                <i class="glyphicon glyphicon-lock"></i>
            </div>
            <input type="submit" class="btn btn-primary style2" value="Reset Sandi">
        </form>
        <footer>
            <a href="{{Route('login')}}" class="forgot pull-left">Login Sekarang</a>
            <a href="{{Route('register')}}" class="register pull-right">Daftar Sekarang</a>
            <div class="clear"></div>
        </footer>
    </div>
</div>
@endsection