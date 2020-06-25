<html lang="en">
@include("layouts.backend.header")
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	@include("layouts.backend.header-mobile")
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-row flex-column-fluid page">
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<div id="kt_header" class="header flex-column header-fixed">
					@auth
                        @include("layouts.backend.admin-navigation-top")
						@include("layouts.backend.admin-navigation-bottom")
                    @else
                        @include("layouts.backend.guest-navigation-top")
					@endif
				</div>
				@yield('content')
				@include("layouts.backend.footer-content")
			</div>
		</div>
	</div>
	@include("layouts.backend.footer")
</body>
</html>
