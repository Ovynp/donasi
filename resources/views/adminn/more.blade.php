@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarAdminmore')
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
                            <h3>Data Donatur untuk kegiatan {{$kegiatan->nama}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <th>No.</th>
                                    <th>Nama Donatur</th>
                                    <th>Jumlah Donasi</th>
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
                                    <td>{{$donatur->created_at->format('d M Y')}}</td>
                                    @if($donatur->media_transfer_id == null)
                                        <td>Donasi Langsung</td>
                                    @else
                                       <td> {{$donatur->mediaTransfer->nama_media}}
                                       <br> No.rek: {{$donatur->mediaTransfer->nomor}}</td>
                                    @endif
                                    <td>
                                        <form action="/admin/{{$kegiatan->id}}/{{$donatur->id}}/updateStatus" method="POST">
                                        {{ csrf_field() }}
                                            <input name="no_hp" type="hidden" value="{{$donatur->no_hp}}">
                                            <button type="submit" class="bbtn btn-success btn-sm" data-position="top-right" onclick="return confirm('Donatur valid ?')">Validasi</button>
                                            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-{{$donatur->id}}">Edit</a>
                                            <a href="/admin/{{$kegiatan->id}}/{{$donatur->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Abaikan Donatur ?')">Abaikan</a>
                                        </form>
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

@foreach($donaturs as $donatur)	
<!-- MODAL EDIT -->
<div class="modal fade" id="edit-{{$donatur->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">Edit Donatur</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
        <form action="/admin/{{$user->id}}/{{$kegiatan->id}}/{{$donatur->id}}/update" method="POST">
            {{ csrf_field() }}
            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                <label for="exampleInputEmail1">Nama Donatur</label>
                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$donatur->nama}}">
                @if($errors->has('nama') ? 'has-error' : '')
                    <span class="help-block">{{$errors->first('nama')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('jumlah_donasi') ? 'has-error' : ''}}">
                <label for="exampleInputEmail1">Jumlah Donasi</label>
                <input name="jumlah_donasi" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{currency_IDR($donatur->jumlah_donasi)}}" type-currency="IDR">
                @if($errors->has('jumlah_donasi') ? 'has-error' : '')
                    <span class="help-block">{{$errors->first('jumlah_donasi')}}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
                <label for="exampleInputEmail1">No.Hp</label>
                <input name="no_hp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$donatur->no_hp}}">
                @if($errors->has('no_hp') ? 'has-error' : '')
                    <span class="help-block">{{$errors->first('no_hp')}}</span>
                @endif
            </div>
            <div class="form-group">
                    @if($donatur->media_transfer_id != null)
                    <label for="exampleInputEmail1">Media Donasi</label>
                        <br>
                        <select name="mediaTransfer">
                        @foreach($media as $md)
                            <option value="{{$md->id}}"  @if($donatur->media_transfer_id == $md->id) selected @endif>{{$md->nama_media}} --- No Rekening : ({{$md->nomor}})</option>
                        @endforeach
                        </select>
                    @endif
                </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">File Bukti</label>
            </div>
            <div class="form-group">
            <a href="" data-toggle="modal" data-target="#bukti">
                <img src="{{$donatur->getBukti()}}" class="img-fluid" style="width:200px">
            </a>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>
</div>
</div>

<!-- MODAL BUKTI -->
<div class="modal fade" id="bukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">Lihat Bukti Donasi</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
        <form action="" method="POST">
            {{ csrf_field() }}
                <div class="form-group">
                    <img src="{{$donatur->getBukti()}}" class="img-fluid" style="width:500px">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@stop