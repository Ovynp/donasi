@extends('layouts.master')

@section('navbar')
<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="{{asset('admin/assets/img/22.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left" method="GET" action="/superAdmin/cari">
					<div class="input-group">
						<input type="text" name="cari" value="" class="form-control" placeholder="Cari Kegiatan...">
						<span class="input-group-btn"><button type="submit" class="btn btn-primary">Cari</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
                                <li><a href="/superAdmin/edituser"><i class="lnr lnr-user"></i> <span>Edit User</span></a></li>
								<li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
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
                                    <h3 class="panel-title">Data Kegiatan Donasi</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
                                            <th>No.</th>
                                            <th>Kegiatan</th>
                                            <th>Batas Donasi</th>
                                            <th>Aksi</th>
                                            <th>Status</th>
											</tr>
										</thead>
										<tbody>
                                        @php $no=1 @endphp
                                        @foreach($data_kegiatan as $kegiatan)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$kegiatan->nama}}</td>
                                                <td>{{$kegiatan->batas_donasi->format('d M Y')}}</td>
                                                <td>
                                                <a href="/superAdmin/{{$kegiatan->id}}/list" class="btn btn-success btn-sm">View</a>
                                                <a href="/kegiatan/{{$kegiatan->id}}/info" class="btn btn-info btn-sm">Info</a>
                                                <a href="/user/{{$kegiatan->users_id}}/{{$kegiatan->id}}/delete" class="btn btn-danger btn-sm delete" onclick="return confirm('Hapus Kegiatan ?')">Delete</a>
                                                </td>
                                                @if($kegiatan->batas_donasi > $sekarang && $kegiatan->target_donasi > $kegiatan->totalDonasi())
                                                <td><span class="label label-success">Aktif</span></td>
                                                @else
                                                <td><span class="label label-danger">Tidak Aktif</span></td>
                                                @endif
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


