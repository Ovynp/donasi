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
        <div class="custom-tabs-line tabs-line-bottom left-aligned">
            <ul class="nav" role="tablist">
                <h3>REGISTRASI KEGIATAN</h3>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-bottom-left1">
            <div class="row">
            <form action="/kegiatan/store" method="POST" enctype="multipart/form-data">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Nama Pengguna</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('name')}}">
                                @if($errors->has('name') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Email</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}">
                                @if($errors->has('email') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Password</label>
                                <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('password')}}">
                                @if($errors->has('password') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Nama Kegiatan</label>
                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('nama')}}">
                                <input name="users_id" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->id}}">
                                @if($errors->has('nama') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('nama')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Alamat Pelaksanaan</label>
                                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('alamat')}}</textarea>
                                @if($errors->has('alamat') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('alamat')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Kontak</label>
                                    <input name="no_hp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('no_hp')}}">
                                    @if($errors->has('no_hp') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('no_hp')}}</span>
                                    @endif
                                </div>
                            <div class="form-group {{$errors->has('batas_donasi') ? 'has-error' : ''}}">
                                <label for="exampleFormControlTextarea1">Batas Donasi</label>
                                <input name="batas_donasi" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('batas_donasi')}}">
                                @if($errors->has('batas_donasi') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('batas_donasi')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('file_pendukung') ? 'has-error' : ''}}">
                                <label for="exampleFormControlTextarea1">File Pendukung</label>
                                <input name="file_pendukung" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('file_pendukung')}}">
                                @if($errors->has('file_pendukung') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('file_pendukung')}}</span>
                                @endif
                           </div>
                            <div class="form-group {{$errors->has('target_donasi') ? 'has-error' : ''}}">
                                <label for="exampleFormControlTextarea1">Target Donasi</label>
                                <input type="text" name="target_donasi" class="form-control" value="{{old('target_donasi')}}" type-currency="IDR">
                                @if($errors->has('target_donasi') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('target_donasi')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('nama_media') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Nama Bank</label>
                                <input name="nama_media" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('nama_media')}}">
                                @if($errors->has('nama_media') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('nama_media')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="profile-right">
                        <button type="submit" class="btn btn-primary btn-toastr" data-position="top-right">Simpan</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="form-group {{$errors->has('nomor') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Nomor Rekening</label>    
                                <input name="nomor" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('nomor')}}">
                                @if($errors->has('nomor') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('nomor')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('nama_pemilik') ? 'has-error' : ''}}">
                                <label for="exampleInputEmail1">Nama Pemilik</label>
                                <input name="nama_pemilik" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('nama_pemilik')}}">
                                @if($errors->has('nama_pemilik') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('nama_pemilik')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('nama_panitia') ? 'has-error' : ''}}">
                                <label for="exampleFormControlTextarea1">Nama Panitia</label>
                                <input name="nama_panitia" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('nama_panitia')}}">
                                @if($errors->has('nama_panitia') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('nama_panitia')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('alamat_panitia') ? 'has-error' : ''}}">
                                <label for="exampleFormControlTextarea1">Alamat</label>
                                <textarea name="alamat_panitia" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('alamat')}}</textarea>
                                @if($errors->has('alamat_panitia') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('alamat_panitia')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('no_telp') ? 'has-error' : ''}}">
                                <label for="exampleFormControlTextarea1">No_Hp</label>
                                <input type="text" name="no_telp" class="form-control" value="{{old('no_telp')}}">
                                @if($errors->has('no_hp') ? 'has-error' : '')
                                    <span class="help-block">{{$errors->first('no_telp')}}</span>
                                @endif
                            </div>
                            </div>
                    </div>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREATE -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">Tambah User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <form action="/user/create" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Akun</label>
                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
@stop