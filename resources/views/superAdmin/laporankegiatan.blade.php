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
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">DAFTAR KEGIATAN</h3>
                            <div class="right">
                                <a href="/cetaklaporan" class="btn btn-sm btn-primary">Cetak Laporan</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Kegiatan</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no=1 @endphp
                                @foreach($kegiatans as $kegiatan)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$kegiatan->nama}}</td>
                                        <td>
                                        <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#cetak-{{$kegiatan->id}}">CETAK</a>
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

@foreach($kegiatans as $kgt)	
<!-- MODAL CETAK -->
<div class="modal fade" id="cetak-{{$kgt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">Filter Tanggal</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
        <form action="/laporankegiatan/{{$kgt->id}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Dari</label>
                <input name="dari" type="date" class="form-control" id="dari" aria-describedby="emailHelp" value={{$kgt->created_at}}>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sampai</label>
                <input name="sampai" type="date" class="form-control" id="sampai" aria-describedby="emailHelp" value={{Carbon\carbon::now()}}>
            </div>
            <button type="submit" class="btn btn-primary">Cetak</button>
        </form>
        </div>
    </div>
</div>
</div>
@endforeach
@stop