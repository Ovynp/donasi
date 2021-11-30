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
										<li><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Edit User</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-bottom-left1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <form action="/user/{{$user->id}}/updateuser" method="POST">
                                                    {{ csrf_field() }}
                                                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                                            <label for="exampleInputEmail1">Nama Pengguna</label>
                                                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->name}}">
                                                            @if($errors->has('name') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('name')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                                            <label for="exampleFormControlTextarea1">Email</label>
                                                            <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                                            @if($errors->has('email') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('email')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                                            <label for="exampleFormControlTextarea1">Password</label>
                                                            <input type="password" name="password" class="form-control">
                                                            @if($errors->has('password') ? 'has-error' : '')
                                                                <span class="help-block">{{$errors->first('password')}}</span>
                                                            @endif
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