@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarSuperAdmin9')
@stop


@section('sidebar')
@if(auth()->user()->role == 'admin')
@include('layouts.includes._navbarAdmin2')
@endif
@include('layouts.includes._sidebarAdmin')
@stop

@section('content')
<div class="main">
<div class="main-content">
				<div class="container-fluid">
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
										<li><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Edit Kegiatan</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-bottom-left1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel">
                                                <div class="panel-body">
                                                @if(auth()->user()->role == 'super admin')
                                                    <form action="/kegiatan/{{$kegiatan->id}}/update" method="POST" enctype="multipart/form-data">
                                                @endif
                                                @if(auth()->user()->role == 'admin')
                                                    <form action="/admin/{{$user->id}}/{{$kegiatan->id}}/updated" method="POST" enctype="multipart/form-data">
                                                @endif
                                                    {{ csrf_field() }}
                                                        <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                                                            <label for="exampleInputEmail1">Nama Kegiatan</label>
                                                            <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$kegiatan->nama}}">
                                                            @if($errors->has('nama') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('nama')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                                                            <label for="exampleInputEmail1">Alamat Pelaksanaan</label>
                                                            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$kegiatan->alamat}}</textarea>
                                                            @if($errors->has('alamat') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('alamat')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
                                                            <label for="exampleInputEmail1">Kontak</label>
                                                            <input name="no_hp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$kegiatan->no_hp}}">
                                                            @if($errors->has('no_hp') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('no_hp')}}</span>
                                                            @endif
                                                        </div>
                                                        @if(auth()->user()->role == 'super admin')
                                                        <div class="form-group {{$errors->has('batas_donasi') ? 'has-error' : ''}}">
                                                            <label for="exampleFormControlTextarea1">Batas Donasi</label>
                                                            <input name="batas_donasi" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value={{$kegiatan->batas_donasi}}>
                                                            @if($errors->has('batas_donasi') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('batas_donasi')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group {{$errors->has('target_donasi') ? 'has-error' : ''}}">
                                                            <label for="exampleFormControlTextarea1">Target Donasi</label>
                                                            <input type="text" name="target_donasi" class="form-control" value="{{currency_IDR($kegiatan->target_donasi)}}" type-currency="IDR">
                                                            @if($errors->has('target_donasi') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('target_donasi')}}</span>
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if(auth()->user()->role == 'admin')
                                                            <input name="batas_donasi" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value={{$kegiatan->batas_donasi}}>
                                                            
                                                            <input type="hidden" name="target_donasi" class="form-control" value="{{currency_IDR($kegiatan->target_donasi)}}" type-currency="IDR">
                                                        @endif
                                                        <div class="form-group {{$errors->has('file_pendukung') ? 'has-error' : ''}}">
                                                            <label for="exampleFormControlTextarea1">File Pendukung</label>
                                                            <input type="file" name="file_pendukung" class="form-control">
                                                            @if($errors->has('file_pendukung') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('file_pendukung')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group {{$errors->has('foto') ? 'has-error' : ''}}">
                                                            <label for="exampleFormControlTextarea1">Foto</label>
                                                            <input type="file" name="foto" class="form-control">
                                                            @if($errors->has('foto') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('foto')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <img src="{{$kegiatan->gettFoto()}}" class="img-fluid" style="width:200px">
                                                        </div>
                                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Simpan Perubahan ?')">Update</button>
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