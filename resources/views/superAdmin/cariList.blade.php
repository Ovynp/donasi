@extends('layouts.master')

@section('navbar')
	@include('layouts.includes._navbarSuperAdmin11')
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