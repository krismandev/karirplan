@extends("layouts.app")
@section('link')

@endsection
@section("konten")

<div class="col-xs-12">
    <div class="sec-box">
        <header>
            <h2 class="heading"> Jabatan Fungsional yang direncanakan :  <span class="UPPERCASE">{{ $jabfung }}</span>  </h2>
        </header>
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
                                    <input type="text" class="form-control" maxlength="15" value="{{$hasil->semester}}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   Angka kredit yang direncanakan: 
                                </td>
                                <td>
                                    <input type="text" class="form-control" maxlength="15" value="{{ $hasil -> target }}" readonly>
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
                <h2 class="heading">Hasil jawaban dari</h2>
            </header>
            <div class="contents">
                <a class="togglethis">Toggle</a>
                <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-10">Pertanyaan</th>
                            <th class="col-md-3">Bukti</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach($detail as $item)
                        <tr>
                            <td>{{$loop->iteration}} {{$item->pertanyaan}}</td>
                            @if($item->type_bukti == "link")
                            <td><a href="{{$item->bukti}}" target="_blank">Cek Bukti</a></td>
                            @elseif ($item->type_bukti == "file")
                            <td><a href="{{url('file/bukti/'.$item->bukti) }}">Cek Bukti</a></td>
                            @else
                            <td>File Tidak Tersedia</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
                </div>
                <div class="clearfix"></div>
            </div>
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

@if (Session::has('error'))
    <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "10000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.error("{{session('error')}}")
    </script>
@endif
    
    <script>
        $(document).ready(function () {
        });
    </script>
    @include("layouts.notifikasi")
@endsection