@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarSuperAdmin10')
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
                                    <h3 class="panel-title">Data User</h3>
                                    <div class="right">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>

                                    </div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
                                            <th>No.</th>
                                            <th>Nama User</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($tampil as $user)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->role}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    <a href="/user/{{$user->id}}/edit" class="btn btn-success btn-sm">Edit</a>
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


