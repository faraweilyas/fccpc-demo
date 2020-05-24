<html lang="en">
<!-- Header -->
@include("layouts.backend.".getAccountType().".header")
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	@include("layouts.backend.".getAccountType().".header-mobile")
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header flex-column header-fixed">
					<!--begin::Top-->
					@include("layouts.backend.".getAccountType().".navigation-top")
					<!--end::Top-->
					<!--begin::Bottom-->
					@include("layouts.backend.".getAccountType().".navigation-bottom")
					<!--end::Bottom-->
				</div>
				<!--end::Header-->
				@yield('content')
				<!--begin::Footer-->
				@include("layouts.backend.".getAccountType().".footer-content")
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Main-->
	<!-- Footer -->
	@include("layouts.backend.".getAccountType().".footer")
</body>
<!--end::Body-->
</html>