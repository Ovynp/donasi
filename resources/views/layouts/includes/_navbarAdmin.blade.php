<nav class="navbar navbar-default navbar-fixed-top">
<div class="brand">
				<a href="index.html"><img src="{{asset('admin/assets/img/22.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left" method="GET" action="/admin/{{$user->id}}/{{$kegiatan->id}}/cari">
					<div class="input-group">
						<input type="text" name="cari" value="" class="form-control" placeholder="Cari Donatur...">
						<span class="input-group-btn"><button type="submit" class="btn btn-primary">Cari</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">{{$valid->count()}}</span>
							</a>
							<ul class="dropdown-menu notifications">
							@foreach($validd as $val)
								<li><a href="#" class="lnr lnr-user"><span class="dot bg-warning"></span> {{$val->nama}}</a></li>
							@endforeach
								<li><a href="/admin/{{$user->id}}/{{$kegiatan->id}}/more" class="more">Lainnya</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{$kegiatan->getFoto()}}" class="img-circle" alt="Avatar"> <span></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="/admin/{{$user->id}}/{{$kegiatan->id}}/edituser"><i class="lnr lnr-user"></i> <span>Edit User</span></a></li>
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