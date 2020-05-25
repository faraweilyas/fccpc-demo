<html lang="en">
<!-- Header -->
@include("layouts.backend.header")
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	@include("layouts.backend.header-mobile")
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header flex-column header-fixed">
					<!--begin::Top-->
					@include("layouts.backend.navigation-top")
					<!--end::Top-->
					<!--begin::Bottom-->
					@guest
						@include("layouts.backend.guest-navigation-bottom")
					@else
						@include("layouts.backend.admin-navigation-bottom")
					@endif
					
					<!--end::Bottom-->
				</div>
				<!--end::Header-->
				@yield('content')
				<!--begin::Footer-->
				@include("layouts.backend.footer-content")
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Main-->
	<!-- Footer -->
	@include("layouts.backend.footer")
</body>
<!--end::Body-->
</html>