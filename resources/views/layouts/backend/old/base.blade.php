<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $details->title }}</title>
    <meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ pc_asset(BE_IMAGE.'favicon/fccpc_favicon.ico') }}" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'global/plugins.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'style.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'toaster.css') }}" />
    <!-- Custom CSS -->
    @yield('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'custom.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'review.css') }}" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed page-loading greyed-out">

    @yield('base_content')

    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <x-icons.arrow-up></x-icons.arrow-up>
          
        </span>
    </div>




    <!-- JavaScript -->
    <script type="text/javascript" defer>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#0BB783",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#D7F9EF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };

    </script>
    {{-- <script type="text/javascript" src="http://unpkg.com/turbolinks" defer></script> --}}
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'global/plugins.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ pc_asset(BE_JS.'jquery.min.js') }}"></script>
    --}}
    <script type="text/javascript" src="{{ pc_asset(BE_JS.'scripts.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_JS.'bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_JS.'toaster.js') }}" defer></script>
    <script src="{{ pc_asset(BE_APP_JS.'functions.js') }}"></script>
    <script src="{{ pc_asset(BE_APP_JS.'app.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_JS.'main.js') }}" defer></script>

    <script type="text/javascript" defer>
        $(document).ready(function ($) {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };
            @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
            @endif
            @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
            @endif
        });

    </script>

    @yield('custom.javascript')

</body>

</html>
