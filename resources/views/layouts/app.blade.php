<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" media="screen" />
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" media="screen" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" media="screen" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet" media="screen" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.accordion.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.custom-scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/selectnav.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/functions.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plan.js')}}"></script>
    @yield("link")
</head>
<body>
<div class="wrapper">
    <div class="structure-row">
        @include("layouts.navigasi")
        <div class="right-sec">
            @include("layouts.header")
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <!-- Isi Konten -->
                        @yield("konten")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield("script")
</body>
</html>