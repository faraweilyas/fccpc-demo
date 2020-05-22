<!-- Header -->
@include('layouts.frontend.header')
<body class="is-home is-loading">
	<!-- Navigation -->
	@include('layouts.frontend.navigation')
	@yield('content')
	<!-- Footer -->
@include('layouts.frontend.footer')
</body>
</html>
