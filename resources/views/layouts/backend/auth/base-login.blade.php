<!-- Header -->
@include('layouts.backend.auth.header')
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	@yield('content')
	<!-- Footer -->
	@include('layouts.backend.auth.footer')
	<!--begin::Page Scripts(used by this page)-->
	<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>