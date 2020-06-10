<head>
    <base href="" />
	<meta charset="utf-8" />
	<title>{{ $details->title }}</title>
	<meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset(BE_IMAGE.'favicon/fccpc_favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/fullcalendar/fullcalendar.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'global/plugins.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'style.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/users/login-3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/wizard/wizard-2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'toaster.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'custom.css') }}" />
</head>
