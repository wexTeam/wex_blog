<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16"
      href="@isset($setting['favicon']){{ asset('uploads/'.$setting['favicon']) }}@endisset">
<title>@isset($setting['site_title']){{ $setting['site_title'] }}@endisset</title>
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
<link rel="stylesheet" href="{{ mix('css/admin-master.css') }}">
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
@yield('stylesheets')