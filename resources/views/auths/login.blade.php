<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Klorofil - Free Bootstrap Dashboard Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/favicon.png')}}">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="{{asset('admin/assets/img/2.png')}}" alt="Klorofil Logo"></div>
							</div>
							@if(session('sukses'))
							<div class="alert alert-success" roles="alert">
								{{session('sukses')}}
							</div>
							@endif
							@if(session('gagal'))
							<div class="alert alert-danger" roles="alert">
								{{session('gagal')}}
							</div>
							@endif
							<form class="form-auth-small" action="/postlogin" method="POST">
							{{csrf_field()}}
								<div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
									<label for="signin-email" class="control-label sr-only">email</label>
									<input name="email" type="input" class="form-control" id="signin-email" value="" placeholder="email">
									@if($errors->has('email') ? 'has-error' : '')
										<span class="help-block">{{$errors->first('email')}}</span>
									@endif
								</div>
								<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input name="password" type="password" class="form-control" id="signin-password" value="" placeholder="Password">
									@if($errors->has('password') ? 'has-error' : '')
										<span class="help-block">{{$errors->first('password')}}</span>
									@endif
								</div>
								<button type="submit" class="btn btn-default btn-lg btn-block">LOGIN</button>
								<div class="bottom">
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Aplikasi Donasi Online Sanggodirajo Berbagi</h1>
							<p>by Ovy Nanda Putri</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
