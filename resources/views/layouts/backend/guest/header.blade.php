<head><base href="">
	<meta charset="utf-8" />
	<title>{{ $details->title }}</title>
	<meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="{{ BE_PLUGIN.'custom/fullcalendar/fullcalendar.bundle.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_PLUGIN.'global/plugins.bundle.css" rel="stylesheet' }}" type="text/css" />
	<link href="{{ BE_PLUGIN.'custom/prismjs/prismjs.bundle.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_CSS.'style.bundle.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_CSS.'pages/users/login-3.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_CSS.'pages/wizard/wizard-2.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_PLUGIN.'custom/uppy/uppy.bundle.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_PLUGIN.'custom/datatables/datatables.bundle.css' }}" rel="stylesheet" type="text/css" />
	<link href="{{ BE_CSS.'custom.css' }}" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="{{ BE_IMAGE.'favicon/fccpc_favicon.ico' }}" />
</head>
<!--end::Head-->
