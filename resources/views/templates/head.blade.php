
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{url('/')}}/assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet"/>
	<link href="{{url('/')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{url('/')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{url('/')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{url('/')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{url('/')}}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{url('/')}}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{url('/')}}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{url('/')}}/assets/css/app.css" rel="stylesheet">
	<link href="{{url('/')}}/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{url('/')}}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{url('/')}}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{url('/')}}/assets/css/header-colors.css" />
    @yield('style')
	<title>Sampah Care - Peduli sampah</title>
</head>
