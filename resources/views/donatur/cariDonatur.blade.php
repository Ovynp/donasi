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
				<form class="navbar-form navbar-left" method="GET" action="/donatur/{{$kegiatan->id}}/cariDonatur">
					<div class="input-group">
						<input type="text" name="cari" value="" class="form-control" placeholder="Cari Donatur...">
						<span class="input-group-btn"><button type="submit" class="btn btn-primary">Cari</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
@stop

@section('sidebar')
    @include('layouts.includes._sidebarDonatur')
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
                            <h3>Data Donatur untuk kegiatan {{$kegiatan->nama}}</h3>
                        </div>
                        <div class="panel-body">
                        <table class="table table-hover">
                                    <thead>
                                        <th>No.</th>
                                        <th>Nama Donatur</th>
                                        <th>Jumlah Donasi</th>
                                        <th>Tanggal Donasi</th>
                                    </thead>
									<tbody>
                                    @php $no=1 @endphp
                                    @foreach($donatur as $donatur)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$donatur->nama}}</td>
                                        <td>{{currency_IDR($donatur->jumlah_donasi)}}</td>
                                        <td>{{$donatur->created_at->format('d M Y')}}</td>
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
@stop