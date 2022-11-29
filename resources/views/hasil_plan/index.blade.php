@extends("layouts.app")
@section("konten")
<div class="content-section">
     <div style="margin: 20px;">
            <a href="plan/input"><button type="button" class="btn btn-primary">Tambah Perencanaan</button></a>
        </div>
    <div class="container-liquid">
       
        <table class="table" align="center">
            <thead>
                <tr>
                    <td>
                        No
                    </td>
                    <td>
                        Semester
                    </td>
                    <td>
                       Angka Kredit
                    </td>
                    <td>
                       Target
                    </td>
                    <td>
                        Aksi
                    </td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($hasil as $data)
                <tr>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        {{ $data -> semester }}
                    </td>
                    <td>
                        {{ $data -> skor }}
                    </td>
                    <td>
                        {{ $data -> target }}
                    </td>
                    <td>
                         <a href="hasil_plan/{{ $data -> id }}">
                          <button class="w3-button">Hapus</button>
                         </a>
                         <a href="hasil_plan/{{ $data -> id }}/detail">
                          <button class="w3-button">Detail</button>
                         </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @php
            if(isset($html)){
                 echo $html;
            } 
        @endphp
        
    </div>
    <div style="margin: 20px;">
            <a href="#"><button type="button" class="btn btn-warning">Simpan Jabatan</button></a>
        </div>
</div>
@endsection

@section("script")
<script type="text/javascript" src="assets/js/raphael-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/morris-0.4.1.min.js"></script>
@endsection