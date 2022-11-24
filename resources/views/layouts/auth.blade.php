<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
    @yield("link")
</head>

<body>
    @yield("konten")
    @yield("script")
    <script type="text/javascript">
        @if (session('status'))
            notif("success","Link untuk mereset kata sandi berhasil dikirim ke email Anda!");
        @elseif ($errors->has('email'))
            notif("error","{{$errors->first('email')}}");
        @elseif ($errors->has('password'))
            notif("error","{{$errors->first('password')}}");
        @elseif ($errors->has('tglLahir'))
            notif("error","{{$errors->first('tglLahir')}}");
        @elseif ($errors->has('jabatan'))
            notif("error","{{$errors->first('jabatan')}}");
        @elseif ($errors->has('pendidikan'))
            notif("error","{{$errors->first('pendidikan')}}");
        @elseif ($errors->has('tglJadi'))
            notif("error","{{$errors->first('tglJadi')}}");
        @elseif ($errors->has('serdos'))
            notif("error","{{$errors->first('serdos')}}");
        @endif
    </script>
</body>
</html>
