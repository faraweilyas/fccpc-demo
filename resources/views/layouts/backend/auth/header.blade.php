<html lang="en">
<!--begin::Head-->
<head><base href="">
	<meta charset="utf-8" />
	<title>{{ $details->title }}</title>
	<meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="{{ asset(BE_PLUGIN.'global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset(BE_CSS.'style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset(BE_CSS.'pages/users/login-3.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset(BE_CSS.'pages/wizard/wizard-2.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ asset(BE_CSS.'toaster.css') }}" media="all">
	<link href="{{ asset(BE_CSS.'custom.css') }}" rel="stylesheet" type="text/css" />
	<script src="{{ asset(BE_JS.'jquery.js') }}"></script>
	<link rel="shortcut icon" href="{{ asset(BE_IMAGE.'favicon/fccpc_favicon.ico') }}" />
</head>
<!--end::Head-->
