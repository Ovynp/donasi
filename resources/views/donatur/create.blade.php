@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarDonatur6')
@stop

@section('sidebar')
@include('layouts.includes._sidebarDonatur')
@stop

@section('content')
<div class="main">
    <div class="main-content">
        <div class="custom-tabs-line tabs-line-bottom left-aligned">
            <ul class="nav" role="tablist">
                <h3>UPLOAD BUKTI DONASI</h3>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-bottom-left1">
            <div class="row">
            <form action="/donatur/store" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body">
                            {{ csrf_field() }}
                                <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Nama Donatur</label>
                                    <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('nama')}}">
                                    <input name="kegiatan_id" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$kegiatan->id}}">
                                    <input name="status" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="1">
                                    @if($errors->has('nama') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('nama')}}</span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('jumlah_donasi') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Jumlah Donasi</label>
                                    <input name="jumlah_donasi" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('jumlah_donasi')}}" type-currency="IDR">
                                    @if($errors->has('jumlah_donasi') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('jumlah_donasi')}}</span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('file_bukti') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Bukti Donasi</label>
                                    <input name="file_bukti" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('file_bukti')}}">
                                    @if($errors->has('file_bukti') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('file_bukti')}}</span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
                                    <label for="exampleFormControlTextarea1">No.Hp</label>
                                    <input name="no_hp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('no_hp')}}" placeholder="+628">
                                    @if($errors->has('no_hp') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('no_hp')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                <label for="media_transfer_id">Media Transfer</label><br>
                                        <select name="mediaTransfer">
                                        @foreach($media as $md)
                                            <option value="{{$md->id}}">{{$md->nama_media}} --- No Rekening : ({{$md->nomor}})</option>
                                        @endforeach
                                        </select>
                                </div>
                                <div class="profile-right">
                                    <button type="submit" class="btn btn-primary btn-toastr" data-position="top-right">Simpan</button>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>        
@stop