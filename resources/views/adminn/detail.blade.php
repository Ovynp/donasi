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
        <div class="panel panel-profile">
            <div class="clearfix">
                <!-- LEFT COLUMN -->
                <div class="profile-left">
                    <!-- PROFILE HEADER -->
                    <!-- END PROFILE HEADER -->
                    <!-- PROFILE DETAIL -->
                    <div class="profile-detail">
                        <div class="profile-info">
            </div>
        </div>
                    </div>
                    <!-- END PROFILE DETAIL -->
                </div>
                <!-- END LEFT COLUMN -->
                    <!-- TABBED CONTENT -->
                    <div class="custom-tabs-line tabs-line-bottom left-aligned">
                        <ul class="nav" role="tablist">
                            <li><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Detail Donatur</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Donatur</label>
                                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$donatur->nama}}" readonly="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jumlah Donasi</label>
                                                <input name="jumlah_donasi" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{currency_IDR($donatur->jumlah_donasi)}}" readonly="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Media Donasi</label>
                                                @if($donatur->media_transfer_id == null)
                                                <input name="jumlah_donasi" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Donasi Langsung" readonly="true">
                                                @else
                                                <input name="jumlah_donasi" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$donatur->mediaTransfer->nama_media}} --- No Rekening : ({{$donatur->mediaTransfer->nomor}})" readonly="true">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">File Bukti</label>
                                                <input name="file_bukti" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$donatur->file_bukti}}" readonly="true">
                                            </div>
                                            <div class="form-group">
                                            <a href="" data-toggle="modal" data-target="#bukti">
                                                <img src="{{$donatur->getBukti()}}" class="img-fluid" style="width:200px">
                                            </a>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">No.Hp</label>
                                                <input type="text" name="no_hp" class="form-control" value="{{$donatur->no_hp}}" readonly="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Tanggal Donasi</label>
                                                <input type="input" name="created_at" class="form-control" readonly="true" value="{{$donatur->created_at->format('d M Y')}}" >
                                            </div>
                                            <a href="" data-toggle="modal" data-target="#edit"><button type="submit" class="btn btn-warning">Edit</button></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- END TABBED CONTENT -->
            </div>
        </div>
    </div>
</div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
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
                <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">No.Hp</label>
                    <input name="no_hp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$donatur->no_hp}}">
                    @if($errors->has('no_hp') ? 'has-error' : '')
                        <span class="help-block">{{$errors->first('no_hp')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan perubahan ?')">Simpan</button>
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

@stop