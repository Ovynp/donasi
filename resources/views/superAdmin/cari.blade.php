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
											</tr>
										</thead>
										<tbody>
										@php $no=1 @endphp
                                        @foreach($tampil as $kegiatan)
                                            <tr>
												<td>{{$no++}}</td>
                                                <td>{{$kegiatan->nama}}</td>
                                                <td>{{$kegiatan->batas_donasi->format('d M Y')}}</td>
                                                <td>
                                                <a href="/donatur/{{$kegiatan->id}}/list" class="btn btn-success btn-sm">View</a>
                                                <a href="/kegiatan/{{$kegiatan->id}}/info" class="btn btn-info btn-sm">Info</a>
                                                <a href="/user/{{$kegiatan->users_id}}/{{$kegiatan->id}}/delete" class="btn btn-danger btn-sm delete">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
										</tbody>
								</div>
							</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop





