@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarAdmin')
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
        @if(session('sukses2'))
        <div class="alert alert-success" roles="alert">
        {{session('sukses2')}}
        </div>
        @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Data Donatur untuk kegiatan {{$kegiatan->nama}}</h3>
                            <div class="right">
                            @if($kegiatan->batas_donasi > $sekarang && $kegiatan->target_donasi > $kegiatan->totalDonasi())
                                <a href="/admin/{{$user->id}}/{{$kegiatan->id}}/createDonatur" class="btn btn-sm btn-primary">Tambah Donatur</a>
                            @else
                            <a href="" class="btn btn-sm btn-primary" disabled onclick="return confirm('Tidak bisa tambah donatur, Target Donasi sudah terpenuhi atau sudah melewati batas donasi')">Tambah Donatur</a>
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <th>No.</th>
                                    <th>Nama Donatur</th>
                                    <th>Jumlah Donasi</th>
                                    <th>No Hp</th>
                                    <th>Tanggal Donasi</th>
                                    <th>Media Transfer</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                <tr>
                                @php $no=1 @endphp
                                @foreach($donaturs as $donatur)
                                    <td>{{$no++}}</td>
                                    <td>{{$donatur->nama}}</td>
                                    <td>{{currency_IDR($donatur->jumlah_donasi)}}</td>
                                    <td>{{$donatur->no_hp}}</td>
                                    <td>{{$donatur->created_at->format('d M Y')}}</td>
                                    @if($donatur->media_transfer_id == null)
                                        <td>Donasi Langsung</td>
                                    @else
                                       <td> {{$donatur->mediaTransfer->nama_media}}</td>
                                    @endif
                                    </td>
                                    </a>
                                    <td>
                                        <a href="/admin/{{$user->id}}/{{$kegiatan->id}}/{{$donatur->id}}/detail" class="btn btn-success btn-sm">Detail</a>
                                        <a href="/admin/{{$kegiatan->id}}/{{$donatur->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Donatur ?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop