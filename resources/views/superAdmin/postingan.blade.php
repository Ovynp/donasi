@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarSuperAdmin9')
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($postingan as $berita)
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$berita->judul}}</h3>
                        </div>
                        <div class="panel-body">
                        <img src="{{$berita->getGaleris()}}" class="img-fluid" style="width:300px; height:150px">
                        </div>
                        <div class="panel-body">
                          <p>{{Illuminate\Support\Str::limit($berita->isi, 100, ' ....')}}</p>
                          <a href="/superAdmin/postingan/{{$berita->id}}/lihat" class="more">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@stop