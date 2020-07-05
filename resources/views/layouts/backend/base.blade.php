<html lang="en">
<head>
    <base href="" />
    <meta charset="utf-8" />
    <title>{{ $details->title }}</title>
    <meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ pc_asset(BE_IMAGE.'favicon/fccpc_favicon.ico') }}" />
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
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">

    @yield('base_content')

	<div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
        </span>
    </div>
    <script>
        var KTAppSettings = {
            "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins"
            };
    </script>
    <style type="text/css" media="screen">
        .turbolinks-progress-bar
        {
            height: 5px;
            background-color: #1BC5BD;
        }
    </style>
    <script type="text/javascript" src="http://unpkg.com/turbolinks" defer></script>
    <script src="{{ pc_asset(BE_PLUGIN.'global/plugins.bundle.js') }}"></script>
    <script src="{{ pc_asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ pc_asset(BE_JS.'scripts.bundle.js') }}"></script>
    <script src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
    <script src="{{ pc_asset(BE_JS.'pages/crud/datatables/advanced/column-rendering.js') }}" defer></script>
    <script src="{{ pc_asset(BE_JS.'pages/crud/forms/widgets/select2.js') }}" defer></script>
    <script src="{{ pc_asset(BE_JS.'pages/custom/wizard/wizard-2.js') }}" defer></script>
    <script src="{{ pc_asset(BE_JS.'toaster.js') }}" defer></script>
    <script src="{{ pc_asset(BE_JS.'custom.js') }}" defer></script>
</body>
</html>
