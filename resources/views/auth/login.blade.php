@extends("layouts.auth")

@section("konten")
<div class="loginwrapper">
    <div class="loginone">
        <header>
            <img src="assets/images/unja.png">
            <h1 class="white margin-3">Login Panel</h1>
            <p>Silahkan login menggunakan NIDN/NIP dan Kata Sandi Anda!</p>
        </header>
                        @if(session('pesan'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{session('pesan')}}</strong></div>
                        @endif
        <form action="{{ route('loginwoy') }}" method="POST">
            {{csrf_field()}}
            <div class="username">
                <input type="text" name="username" class="form-control" placeholder="NIDN/NIP">
                <i class="glyphicon glyphicon-envelope"></i>
            </div>
            <div class="password">
                <input type="password" name="password" class="form-control" placeholder="Kata Sandi" minlength="6" required>
                <i class="glyphicon glyphicon-lock"></i>
            </div>
            <input type="submit" class="btn btn-primary style2" value="Login">
        </form>
        <footer>
            
        </footer>
    </div>
</div>
@endsection