@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarDonatur5')
@stop

@section('sidebar')
@include('layouts.includes._sidebarDonatur')
@stop

@section('content')
<div class="main">
    <div class="main-content">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="container">
                        <img src="images/4.jpg" style="width:1100px; height:500px; margin:auto; transition-duration: 0.2s;" >
                        <div class="content">
                            <center><h1>AYO BERDONASI</h1></center>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15948.05775045941!2d101.43757416911549!3d-2.1481590322293536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2d9925760709d7%3A0x619d58f9f3560f88!2sSemerap%2C%20Keliling%20Danau%2C%20Kabupaten%20Kerinci%2C%20Jambi!5e0!3m2!1sid!2sid!4v1626007996379!5m2!1sid!2sid" width="1100" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <div class="content">
                            <center><h1>LOKASI 5 DESA KEDEPATIAN SEMERAP</h1></center>
                        </div>
                    </div>
                </div>
               
                @foreach($tampil as $tmp)
                @if($tmp->foto != null)
                <div class="item">
                    <div class="container">
                    
                        <a href="#section-1">
                            
                            <img src="{{$tmp->gettFoto()}}" style="width:1100px; height:500px; margin:auto; transition-duration: 0.2s;">
                           
                            <center>
                                <div class="content">    
                                    <h1>PENGUMPULAN DONASI</h1>
                                    <h2>{{$tmp->nama}}</h2>
                                </div>
                            </center>
                        </a>
                        
                    </div>
                </div>
                @endif
                @endforeach
                    <!-- membuat panah next dan previous -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
                <div class="container-fluid" id="section-1">
                    @if(session('sukses'))
                    <div class="alert alert-success" roles="alert">
                        {{session('sukses')}}
                    </div>
                    @endif
                    @if(session('sukses1'))
                    <div class="alert alert-success" roles="alert">
                        {{session('sukses1')}}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <tbody>
                                        @php $no=1 @endphp
                                        @foreach($tampil as $kegiatan)
                                        @if($kegiatan->totalDonasi() < $kegiatan->target_donasi)
                                        <div class="col-md-4">
                                            <div class="panel">
                                                <table>
                                                    <tr>
                                                        <div class="panel-heading">
                                                        <center><h3 class="panel-title"><strong>{{$kegiatan->nama}}</strong></h3></center>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="panel-body">
                                                            <img src="{{$kegiatan->gettFoto()}}" class="img-fluid" style="width:300px; height:150px">
                                                        </div>
                                                    </tr> 
                                                    <tr>
                                                        <center><strong>Sisa {{Carbon\Carbon::parse($sekarang)->diffinDays($kegiatan->batas_donasi)}} hari Lagi</strong></center>
                                                        <center><strong>Donasi Terkumpul : {{currency_IDR($kegiatan->totalDonasi()) }}</strong></center>
                                                        <center><strong>Target Donasi : {{currency_IDR($kegiatan->target_donasi)}}</strong></center>
                                                        <center><strong><a href="/donatur/{{$kegiatan->id}}/list" class="more">Lihat Daftar Donatur</a></strong></center>
                                                        <input type="range" name="angka" min="0" max="100" value="{{round($kegiatan->totalDonasi()/$kegiatan->target_donasi*100)}}" readonly>
                                                    </tr>
                                                    <tr>
                                                        <div class="panel-body">
                                                        File Pendukung : 
                                                                @if($kegiatan->file_pendukung != null)
                                                                <a href="/donatur/{{$kegiatan->id}}/file">{{$kegiatan->file_pendukung}}</a>
                                                                @else
                                                            <strong>-</strong>
                                                                @endif
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <center><a class="btn btn-info btn-sm info" aria-hidden="true" data-toggle="modal" data-target="#info-{{$kegiatan->id}}">Info Panitia</a>
                                                        <a href="#" class="btn btn-danger btn-sm delete"  data-toggle="modal" data-target="#donasi-{{$kegiatan->id}}">Donasi</a></center>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
</div>
    

<!-- MODAL DONASI -->
@foreach($tampil as $kegiatan)
<div class="modal fade" id="donasi-{{$kegiatan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">INFO KEGIATAN</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <form action="/donatur/{{$kegiatan->id}}/bukti" method="GET" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                    <div class="card-body">
                        <h4 class="card-text">Silakan salurkan donasi anda ke nomor rekening berikut</h4>
                        @foreach($kegiatan->mediaTransfers as $media)
                        <h3>{{$media->nama_media}} : {{$media->nomor}} a.n {{$media->nama_pemilik}}</h3>
                        @endforeach
                        <h4>Jika Sudah Melakukan Transfer, Tekan SELANJUTNYA untuk melakukan upload bukti donasi</h4>
                    </div>
                    </div>
                <button type="submit" class="btn btn-danger">SELANJUTNYA</button>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach

<!-- MODAL INFO -->
@foreach($tampil as $kegiatan)
<div class="modal fade" id="info-{{$kegiatan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">INFORMASI PANITIA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
        <table class="table table-hover">
            <thead>
                <td>Nama Panitia</td>
                <td>No.Hp</td>
                <td>Alamat</td>
            </thead>
            <tbody>
            @foreach($kegiatan->panitias as $panitia)
                <tr>
                    <td>{{$panitia->nama}}</td>
                    <td>{{$panitia->no_telp}}</td>
                    <td>{{$panitia->alamat}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
</div>
@endforeach
@stop


