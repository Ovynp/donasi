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
            <div class="container-fluid">
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
                                        @php $no=1 @endphp
                                        @foreach($tampil as $kegiatan)
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
                                        @endforeach
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
                        <p class="card-text">Silakan salurkan donasi anda ke nomor rekening berikut</p>
                        @foreach($kegiatan->mediaTransfers as $media)
                        <p>{{$media->nama_media}} : {{$media->nomor}} a.n {{$media->nama_pemilik}}</p>
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
@stop


