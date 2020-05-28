<html lang="en">
<!-- Header -->
@include('layouts.backend.header')
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	@yield('content')
	<!-- Footer -->
	@include('layouts.backend.footer')
</body>
<!--end::Body-->
</html>