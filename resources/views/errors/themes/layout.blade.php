<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    @yield('error_style')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'global/plugins.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'style.bundle.css') }}" />
    {{-- <link rel="shortcut icon" href="{{ pc_asset(BE_IMAGE.'favicon/fccpc_favicon.ico') }}" /> --}}
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.fccpc.gov.ng/uploads/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.fccpc.gov.ng/uploads/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.fccpc.gov.ng/uploads/favicons/favicon-16x16.png">
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
    @yield('theme')
    <script type="text/javascript">
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
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'global/plugins.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/prismjs/prismjs.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_JS.'scripts.bundle.js') }}"></script>
</body>
</html>
