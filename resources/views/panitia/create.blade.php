@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarLogin')
@stop

@section('sidebar')
@include('layouts.includes._sidebarAdmin')
@stop

@section('content')
<div class="main">
    <div class="main-content">
        <div class="custom-tabs-line tabs-line-bottom left-aligned">
            <ul class="nav" role="tablist">
                <li>
                    <a href="#tab-bottom-left1" role="tab" data-toggle="tab">Tambah Panitia <span>(Tahap 2 dari 3 tahap)</span></a>
                </li>
            </ul>
        </div>
        <div class="panel-heading">
            <div class="right">
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal4"><i class="lnr lnr-plus-circle"></i></button>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-bottom-left1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
								<table class="table project-table">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Alamat</th>
                                            <th>No.hp</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($kegiatan->panitias as $panitia)
										<tr>
											<td>
                                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="">
                                            </td>
                                            <td>
                                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="">  
                                            </td>
                                            <td>
                                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="">  
                                            </td>
											<td>
												<a href="" class="lnr lnr-pencil" data-toggle="modal" data-target="#exampleModal1"></a>
												<a href="" class="lnr lnr-trash"></a>
											</td>
										</tr>
                                    @endforeach
									</tbody>
								</table>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- EXAMPLE MODAL 4 -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Edit Panitia</h5>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        	<div class="modal-body">
            <form action="/panitia/{{$panitia->kegiatan_id}}/store" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
					<div class="form-group">
						<label for="exampleInputEmail1">Nama Panitia</label>
						<input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$panitia->nama}}">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Alamat</label>
						<input name="alamat" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$panitia->alamat}}">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">No. Hp</label>
						<input name="no_telp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$panitia->no_telp}}">
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop