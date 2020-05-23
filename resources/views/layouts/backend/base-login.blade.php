<!-- Header -->
@include('layouts.backend.header')
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	@yield('content')
	<!-- Footer -->
	@include('layouts.backend.footer')
	<!--begin::Page Scripts(used by this page)-->
	<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>