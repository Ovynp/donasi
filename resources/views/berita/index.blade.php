@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarAdmin2')
@stop

@section('sidebar')
@include('layouts.includes._sidebarAdmin')
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
                        <div class="panel-heading">
                            <h3>Postingan Kegiatan</h3>
                            <div class="right">
                                <a href="/postingan/{{$user->id}}/{{$kegiatan->id}}/create" class="btn btn-sm btn-primary">Tambah Postingan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($kegiatan->beritas as $berita)
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$berita->judul}}</h3>
                            <div class="right">
                                <a href="/postingan/{{$user->id}}/{{$kegiatan->id}}/{{$berita->id}}/edit" class="lnr lnr-pencil"></a>
								<a href="/postingan/{{$user->id}}/{{$kegiatan->id}}/{{$berita->id}}/delete" class="lnr lnr-trash" onclick="return confirm('Hapus Postingan ?')"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                        <img src="{{$berita->getGaleris()}}" class="img-fluid" style="width:300px; height:150px">
                        </div>
                        <div class="panel-body">
                          <p>{{Illuminate\Support\Str::limit($berita->isi, 100, ' ....')}}</p>
                          <a href="/postingan/{{$user->id}}/{{$kegiatan->id}}/{{$berita->id}}/show" class="more">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@stop