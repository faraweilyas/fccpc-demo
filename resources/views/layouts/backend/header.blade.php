<head><base href="">
	<meta charset="utf-8" />
	<title>{{ $details->title }}</title>
	<meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ asset(BE_PLUGIN.'custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset(BE_PLUGIN.'global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset(BE_CSS.'style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ asset(BE_CSS.'pages/users/login-3.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset(BE_CSS.'pages/wizard/wizard-2.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="{{ asset(BE_CSS.'toaster.css') }}" media="all">
		<link href="{{ asset(BE_CSS.'custom.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
	<link rel="shortcut icon" href="{{ asset(BE_IMAGE.'favicon/fccpc_favicon.ico') }}" />
</head>
<!--end::Head-->
