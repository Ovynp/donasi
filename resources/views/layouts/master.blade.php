<!doctype html>
<html lang="en">

<head>
	<title>Dashboard | Klorofil - Free Bootstrap Dashboard Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/chartist/css/chartist-custom.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/favicon.png')}}">
	<style>
	<style>
    * {margin: 0; padding: 0}
    html {
        scroll-behavior: smooth;
    }
    #section-1 {
        height: 100%;
        padding: 10px;
        background-color: silver;
    }
	.container {
	position: relative;
	max-width: 100%; /* Maximum width */
	margin: auto; /* Center it */
	}

	.container .content {
	position: absolute; /* Position the background text */
	bottom: 0; /* At the bottom. Use top:0 to append it to the top */
	background: rgb(0, 0, 0); /* Fallback color */
	background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
	color: #f1f1f1; /* Grey text */
	width: 100%; /* Full width */
	padding: 0; /* Some padding */
	}
</style>	
	</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		@yield('navbar')
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@yield('sidebar')
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		@yield('content')
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('admin\assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('admin\assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('admin\assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('admin\assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('admin\assets/vendor/chartist/js/chartist.min.js')}}"></script>
	<script src="{{asset('admin\assets/scripts/klorofil-common.js')}}"></script>
	<script>
		document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
		element.addEventListener('keyup', function(e) {
		let cursorPostion = this.selectionStart;
			let value = parseInt(this.value.replace(/[^,\d]/g, ''));
			let originalLenght = this.value.length;
			if (isNaN(value)) {
			this.value = "";
			} else {    
			this.value = value.toLocaleString('id-ID', {
				currency: 'IDR',
				style: 'currency',
				minimumFractionDigits: 0
			});
			cursorPostion = this.value.length - originalLenght + cursorPostion;
			this.setSelectionRange(cursorPostion, cursorPostion);
			}
		});
		});
	</script>
</body>

</html>
