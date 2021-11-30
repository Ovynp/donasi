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
			<div class="panel panel-profile">
				<div class="clearfix">
				<!-- LEFT COLUMN -->
					<div class="profile-left">
					<!-- PROFILE HEADER -->
						<div class="profile-header">
							<div class="overlay"></div>
								<div class="profile-main">
									<img src="{{$kegiatan->getFoto()}}" class="img-circle" alt="Avatar">
									<h3 class="name">{{$kegiatan->nama}}</h3>
									@if($kegiatan->batas_donasi > $sekarang && $kegiatan->target_donasi > $kegiatan->totalDonasi())
									<span class="online-status status-available">Aktif</span>
									@else
									<span class="online-status status-unavailable">Tidak Aktif</span>
									@endif
								</div>
							<div class="profile-stat">
								<div class="row">
									<div class="col-md-4 stat-item">
										Batas Donasi<span>{{$kegiatan->batas_donasi->format('d M Y')}}</span>
									</div>
									<div class="col-md-4 stat-item">
										Donasi Terkumpul<span>{{currency_IDR($kegiatan->totalDonasi())}}</span>
									</div>
									<div class="col-md-4 stat-item">
										Jumlah Donatur<span>{{$donatur->count()}}</span>
									</div>
								</div>
							</div>
						</div>
					<!-- END PROFILE HEADER -->
					<!-- PROFILE DETAIL -->
						<div class="profile-detail">
							<div class="profile-info">
                                <div class="text-center"><a href="/kegiatan/{{$kegiatan->id}}/edit" class="btn btn-primary">Edit Profil</a></div>
							</div>
						</div>
					<!-- END PROFILE DETAIL -->
					</div>
				<!-- END LEFT COLUMN -->
				<!-- RIGHT COLUMN -->
					<div class="profile-right">
					<!-- TABBED CONTENT -->
						<div class="custom-tabs-line tabs-line-bottom left-aligned">
							<ul class="nav" role="tablist">
								<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Profil</a></li>
								<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Panitia</a></li>
								<li><a href="#tab-bottom-left3" role="tab" data-toggle="tab">Media Transfer</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-bottom-left1">
								<div class="panel">
                                    <div class="panel-body">
										<table class="table">
											<tr>
												<th>Nama Kegiatan</th>
												<td>{{$kegiatan->nama}}</td>
											</tr>
											<tr>
												<th>Alamat Pelaksanaan</th>
												<td>{{$kegiatan->alamat}}</td>
											</tr>
											<tr>
												<th>Kontak</th>
												<td>{{$kegiatan->no_hp}}</td>
											</tr>
											<tr>
												<th>Target Donasi</th>
												<td>{{currency_IDR($kegiatan->target_donasi)}}</td>
											</tr>
											<tr>
												<th>File Pendukung</th>
												<td><a href="/kegiatan/{{$user}}/{{$kegiatan->id}}/File">{{$kegiatan->file_pendukung}}</a></td>
											</tr>
											<tr>
												<th>Batas Donasi</th>
												<td>{{$kegiatan->batas_donasi->format('d M Y')}}</td>
											</tr>
										</table>
                                    </div>
                                </div>
							</div>
							<div class="tab-pane fade" id="tab-bottom-left2">
								<div class="table-responsive">
									<div class="panel-heading">
										<div class="right">
											<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal2"><i class="lnr lnr-plus-circle"></i></button>
										</div>
									</div>
								</div>
								<table class="table project-table">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama</th>
											<th>Alamat</th>
                                            <th>No.hp</th>
										</tr>
									</thead>
									<tbody>
									@php $no=1 @endphp
                                    @foreach($panitia as $data)
										<tr>
											<td>{{$no++}}</td>
											<td>{{$data->nama}}</td>
                                            <td>{{$data->alamat}}</td>
                                            <td>{{$data->no_telp}}</td>
											<td>
												<a href="" class="lnr lnr-pencil" data-toggle="modal" data-target="#exampleModal1-{{$data->id}}"></a>
												<a href="/panitia/{{$data->id}}/delete" class="lnr lnr-trash" onclick="return confirm('Hapus Panitia ?')"></a>
											</td>
										</tr>
                                    @endforeach
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="tab-bottom-left3">
								<div class="table-responsive">
									<div class="row">
                                    <!-- BASIC TABLE -->
                                        <div class="panel">
                                            <div class="panel-body">
												<div class="panel-heading">
													<div class="right">
														<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal3"><i class="lnr lnr-plus-circle"></i></button>
													</div>
												</div>
                                               	<table class="table">
                                                    <thead>
                                                        <tr>
															<th>No.</th>
                                                            <th>Bank</th>
                                                            <th>No.rekening</th>
                                                            <th>A.n</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													@php $no=1 @endphp
                                                	@foreach($mediaTransfer as $media)
                                                        <tr>
															<td>{{$no++}}</td>
                                                            <td>{{$media->nama_media}}</td>
                                                            <td>{{$media->nomor}}</td>
                                                            <td>{{$media->nama_pemilik}}</td>
															<td>
																<a href="" class="lnr lnr-pencil" data-toggle="modal" data-target="#exampleModal-{{$media->id}}"></a>
																<a href="/mediaTransfer/{{$media->id}}/delete" class="lnr lnr-trash" onclick="return confirm('Hapus Media Transfer ?')"></a>
															</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <!-- END BASIC TABLE -->
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@foreach($kegiatan->mediaTransfers as $mt)		
<!-- EXAMPLE MODAL -->
<div class="modal fade" id="exampleModal-{{$mt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Media Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mediaTransfer/{{$mt->id}}/update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
					<div class="form-group {{$errors->has('nama_media') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nama Bank</label>
						<input name="nama_media" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$mt->nama_media}}">
						@if($errors->has('nama_media') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nama_media')}}</span>
						@endif
					</div>
					<div class="form-group {{$errors->has('nomor') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nomor Rekening</label>
						<input name="nomor" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$mt->nomor}}">
						@if($errors->has('nomor') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nomor')}}</span>
						@endif
					</div>
					<div class="form-group {{$errors->has('nama_pemilik') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Atas Nama</label>
						<input name="nama_pemilik" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$mt->nama_pemilik}}">
						@if($errors->has('nama_pemilik') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nama_pemilik')}}</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary" onclick="return confirm('Simpan Perubahan ?')">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($panitia as $panitiaa)
<!-- EXAMPLE MODAL 1 -->
<div class="modal fade" id="exampleModal1-{{$panitiaa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Panitia</h5>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        	<div class="modal-body">

                <form action="/panitia/{{$panitiaa->id}}/update" method="POST">
                {{ csrf_field() }}
					<div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nama Panitia</label>
						<input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$panitiaa->nama}}">
						@if($errors->has('nama') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nama')}}</span>
						@endif
					</div>
					<div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Alamat</label>
						<input name="alamat" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$panitiaa->alamat}}">
						@if($errors->has('alamat') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('alamat')}}</span>
						@endif
					</div>
					<div class="form-group {{$errors->has('no_telp') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">No. Hp</label>
						<input name="no_telp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$panitiaa->no_telp}}">
						@if($errors->has('no_telp') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('no_telp')}}</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary" onclick="return confirm('Simpan Perubahan ?')">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- EXAMPLE MODAL 2-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Tambah Panitia</h5>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        	<div class="modal-body">
                <form action="/panitia/{{$kegiatan->id}}/create" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
					<div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nama Panitia</label>
						<input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Panitia" value="{{old('nama')}}">
						<input name="kegiatan_id" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Panitia" value="{{$panitiaa->kegiatan_id}}">
						@if($errors->has('nama') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nama')}}</span>
						@endif
					</div>
					<div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Alamat</label>
						<input name="alamat" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat Panitia" value="{{old('alamat')}}">
						@if($errors->has('alamat') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('alamat')}}</span>
						@endif
					</div>
					<div class="form-group {{$errors->has('no_telp') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">No. Hp</label>
						<input name="no_telp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No.hp" value="{{old('no_telp')}}">
						@if($errors->has('no_telp') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('no_telp')}}</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EXAMPLE MODAL 3-->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Tambah Media Transfer</h5>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        	<div class="modal-body">
                <form action="/mediaTransfer/{{$kegiatan->id}}/create" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
					<div class="form-group  {{$errors->has('nama_media') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nama Bank</label>
						<input name="nama_media" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Bank" value="{{old('nama_media')}}">
						<input name="kegiatan_id" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Panitia" value="{{$kegiatan->id}}">
						@if($errors->has('nama_media') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nama_media')}}</span>
						@endif
					</div>
					<div class="form-group  {{$errors->has('nomor') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nomor Rekening</label>
						<input name="nomor" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Rekening" value="{{old('nomor')}}">
						@if($errors->has('nomor') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nomor')}}</span>
						@endif
					</div>
					<div class="form-group  {{$errors->has('nama_pemilik') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Atas Nama</label>
						<input name="nama_pemilik" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="A.n" value="{{old('nama_pemilik')}}">
						@if($errors->has('nama_pemilik') ? 'has-error' : '')
							<span class="help-block">{{$errors->first('nama_pemilik')}}</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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