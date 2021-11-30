@extends('layouts.master')

@section('navbar')
@include('layouts.includes._navbarDonatur6')
@stop

@section('sidebar')
@include('layouts.includes._sidebarDonatur')
@stop

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12"> 
             <center><h1>{{$berita->judul}}</h1><span>{{$user->name}}/{{$berita->created_at->format('d M Y')}}</span></center></br>
            </div>
          </div>
            <html>
              <body>
                <div class="container">	
                  <div class="col-md-6 col-md-offset-3">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                      <!-- <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>		
                      </ol> -->
                    <!-- deklarasi carousel -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{$berita->getGaleris()}}" class="img-fluid" style="width:400px; height:300px; margin:auto">
                        </div>
                        @foreach($galeris as $galeri)
                        <div class="item">
                            <img src="{{$galeri->getFoto()}}" class="img-fluid" style="width:400px; height:300px; margin:auto">
                        </div>
                        @endforeach
                    <!-- membuat panah next dan previous -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </body>
            </html>
            <div class="row">
            <div class="panel-body">
            <div class="col-md-12"> </br>
            <font size="4">
             <p style="text-align: justify; text-indent: 45px; font-family: 'Times New Roman'">{{$berita->isi}}</p>
             </font>
             </div>
            </div>
          </div>
          </div>
        </div>
      </div>
@stop