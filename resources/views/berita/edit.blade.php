@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarAdmin')
@stop

@section('sidebar')
@include('layouts.includes._sidebarAdmin')
@stop

@section('content')
<div class="main">
    <div class="main-content">
        <!-- END LEFT COLUMN -->
            <!-- TABBED CONTENT -->
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Edit Postingan</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/postingan/{{$user->id}}/{{$kegiatan->id}}/{{$beritas->id}}/update" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group {{$errors->has('judul') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Judul Postingan</label>
                                    <input name="judul" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$beritas->judul}}">
                                    @if($errors->has('judul') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('judul')}}</span>
                                    @endif
                                    <input name="kegiatan_id" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$kegiatan->id}}">
                                </div>
                                <div class="form-group {{$errors->has('foto') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Foto</label>
                                @foreach($galeris as $galeri)
                                   <input name="foto" type="hidden" multiple class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$galeri->foto}}">
                                @endforeach
                                   <input name="foto[]" type="file" multiple class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                                   @if($errors->has('foto') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('foto')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                @foreach($galeris as $galeri)
                                    <img src="{{$galeri->getFoto()}}" class="img-fluid" style="width:200px">
                                @endforeach
                                </div>
                                <div class="form-group {{$errors->has('thumbnail') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Thumbnail</label>
                                    <input name="thumbnail" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @if($errors->has('thumbnail') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('thumbnail')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <img src="{{$beritas->getGaleris()}}" class="img-fluid" style="width:300px"> 
                                </div>
                                <div class="form-group {{$errors->has('isi') ? 'has-error' : ''}}">
                                    <label for="exampleInputEmail1">Isi Postingan</label>
                                    <textarea name="isi" class="form-control" id="exampleFormControlTextarea1" rows="8">{{$beritas->isi}}</textarea>
                                    @if($errors->has('isi') ? 'has-error' : '')
                                        <span class="help-block">{{$errors->first('isi')}}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Simpan Perubahan ?')">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- END TABBED CONTENT -->
        </div>
    </div>
</div>
@stop