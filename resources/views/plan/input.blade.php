@extends("layouts.app")
@section('link')

@endsection
@section("konten")
<form action="{{ route('kirim_plan') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Identitas Perencana</h2>
        </header>
        <div class="contents">
            <a class="togglethis">Toggle</a>
             <div class="table-box">
                <table class="table">
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td width="30%;">
                                Nama : 
                            </td>
                            <td>
                               {{$item -> gelar_depan}} {{ $item -> nama_pegawai }}, {{$item->gelar_belakang}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NIP :
                            </td>
                            <td>
                                {{ $item -> nip }}
                                <input type="hidden" name="nip_pegawai" value="{{ $item -> id_pegawai }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jabatan Fungsional saat ini :
                            </td>
                            <td>
                                {{ $item -> nama_jabfung }}    
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                Jabatan Fungsional yang direncanakan :
                            </td>
                            <td>
                                <select name="plan_jabfung" class="form-control" style="width: 30%;" id="plan_jabfung">
                                    <option value="0">Pilih Jabatan Fungsional</option>
                                    @foreach($jabfung as $option)
                                    <option value="{{$option -> angka_kredit}}">{{ $option -> nama_jabfung }} - {{ $option -> angka_kredit }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
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
                                    <input type="text" name="semester" class="form-control" maxlength="15" placeholder="Contoh: 20181" id="namaSemester">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Mulai Semester:
                                </td>
                                <td>
                                    <input type="date" name="" class="form-control" id="awalSemester" placeholder="Contoh: 01/01/2018">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tanggal Akhir Semester:
                                </td>
                                <td>
                                    <input type="date" name="" class="form-control" id="akhirSemester" placeholder="Contoh: 01/01/2018">
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th class="col-md-9">Angka kredit saat ini</th>
                                <th class="col-md-4">Angka kredit yang direncanakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @foreach($data as $item)
                                    {{ $item -> angka_kredit }}
                                    @endforeach
                                </td>
                                <td>
                                    <span id="plan_kredit"></span>
                                    <input type="hidden" name="jabfung" id="plan_kredit">
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


@foreach($listUnsur as $unsur)
<div class="col-xs-12">
    <div class="sec-box">
        <a class="closethis">Close</a>
        <header>
            <h2 class="heading">Perencanaan Unsur {{$unsur->nama_unsur}}</h2>
        </header>
        <div class="contents">  
            <a class="togglethis">Toggle</a>
            <div class="table-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-0">No</th>
                            <th class="col-md-10">Pertanyaan</th>
                            <th class="col-md-3">Jawaban</th>
                        </tr>
                       
                    </thead>
                    <tbody>

                        <tr class="bold uppercase">
                        
                           
                            <td class="parentJudul">{{$unsur->kode_unsur}}</td>
                    
                            <td colspan="3">{{$unsur->nama_unsur}}</td>
                        </tr>
                            @foreach($listSubUnsur as $subUnsur)
                                @if($unsur->id_unsur == $subUnsur->id_unsur)
                                    <tr class="bold uppercase">
                                  
                                    
                                        <td class="subJudul">#</td>
                                        <td colspan="3">{{$subUnsur->nama_subUnsur}}</td>
                                    </tr>
                                    
                                        @foreach($listPertanyaan  as $item)
                                            @if($item->id_subUnsur == $subUnsur->id_subUnsur )
                                            <tr>
                                                <td></td>
                                                <td> {{$item->pertanyaan}}</td>
                                                @if($item->jenis == 1)
                                                <td>
                                                    <select class="form-control" id="{{$item->kode}}" name="{{$item->kode}}">
                                                        <option value="1">Ya</option>
                                                        <option value="0" selected>Tidak</option>
                                                    </select>
                                                </td>
                                                @elseif($item->jenis == 2)
                                                <td>
                                                    <div class="input-group">
                                                        <input type="text" id="{{$item->kode}}" class="form-control" value="0" onkeypress="return validasi_number(event)" maxlength="3" name="{{$item->kode}}">
                                                        <span class="input-group-addon btn-default">{{$item->satuan}}</span>
                                                    </div>
                                                </td>
                                                @elseif($item->jenis == 3)
                                                <td>
                                                    <select class="form-control" id="{{$item->kode}}" name="{{$item->kode}}">
                                                        @foreach($listPertanyaanDropdown as $dropdown)
                                                            @if($dropdown->pertanyaan_id == $item->id_pertanyaan)
                                                            <!-- harus ambil dari db -->
                                                                <option value="{{$dropdown->kredit}}">{{$dropdown->judul}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @endif
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="bold">
                                                    
                                                    Bukti (Inputkan Salah Satu)  
                                                    </td>
                                                    <td>
                                                        <div class="input-control mb-3">
                                                            <input class="form-control" type="text" placeholder="Masukkan Link Bukti" name="bukti_{{$item->kode}}" value="">
                                                        </div><br/>
                                                        <div class="input-control mt-3">
                                                            <input class="form-control" type="file" name="bukti_{{$item->kode}}" value="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            
                                            </tr>
                                                
                                            @endif
                                        @endforeach
                                @endif  
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endforeach

<div class="col-xs-12 right">
    <button class="btn btn-md btn-success" type="submit">Simpan Perencanaan</button>
</div>
</form>
                       
                    

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