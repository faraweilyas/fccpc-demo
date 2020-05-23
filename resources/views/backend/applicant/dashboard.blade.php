<!-- Header -->
@include("layouts.backend.{{ getAccountType() }}.header")
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	@include("layouts.backend.{{ getAccountType() }}.header-mobile")
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header flex-column header-fixed">
					<!--begin::Top-->
					@include("layouts.backend.{{ getAccountType() }}.navigation-top")
					<!--end::Top-->
					<!--begin::Bottom-->
					@include("layouts.backend.{{ getAccountType() }}.navigation")
					<!--end::Bottom-->
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
					<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
						<!--begin::Info-->
						<div class="d-flex align-items-center flex-wrap mr-1">
							<!--begin::Page Heading-->
							<div class="d-flex align-items-baseline mr-5">
								<!--begin::Page Title-->
								<h5 class="text-dark font-weight-bold my-2 mr-5">Select Transaction Type</h5>
								<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
									<li class="breadcrumb-item">
										<a href="<?= __url('/application/dashboard/'.$id); ?>" class="text-muted">Home</a>
									</li>
								</ul>
								<!--end::Page Title-->
							</div>
							<!--end::Page Heading-->
						</div>
						<!--end::Info-->
					</div>
				</div>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Dashboard-->
							 <div class="row">
                    			<div class="col-md-4">
	                        		<!--begin::Tiles Widget 11-->
	                        		<a href="<?= __url('/application/create/'.$id); ?>">
										<div class="card card-custom bg-success gutter-b" style="height: 150px">
										    <div class="card-body">
										        <span class="svg-icon svg-icon-2x svg-icon-white ml-n2">
										        	<!--begin::Svg Icon | path:/metronic/themes/metronic/theme/html/demo5/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
											        	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"></rect>
													        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
													        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												<span class="svg-icon svg-icon-white svg-icon-2x float-right">
													<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-right.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <polygon points="0 0 24 0 24 24 0 24"/>
													        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"/>
													        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
										        <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">Application</div>
										        <span class="text-inverse-success font-weight-bold font-size-lg mt-1"><small>Submit Application</small></span>
										    </div>
										</div>
									</a>
									<!--end::Tiles Widget 11-->
			                    </div>
			                    <div class="col-md-4">
			                        <!--begin::Tiles Widget 12-->
			                        <a href="#">
										<div class="card card-custom gutter-b" style="height: 150px">
										    <div class="card-body">
										       <span class="svg-icon svg-icon-primary svg-icon-2x">
											       	<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo5/dist/../src/media/svg/icons/Code/Warning-1-circle.svg-->
											       	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"/>
													        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
													        <rect fill="#000000" x="11" y="7" width="2" height="8" rx="1"/>
													        <rect fill="#000000" x="11" y="16" width="2" height="2" rx="1"/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												<span class="svg-icon svg-icon-primary svg-icon-2x float-right">
													<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-right.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <polygon points="0 0 24 0 24 24 0 24"/>
													        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"/>
													        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
										        <div class="text-dark font-weight-bolder font-size-h2 mt-3">Enquiry</div>
										        <span class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"><small>Submit Enquiry</small></span>
										    </div>
										</div>
									</a>
									<!--end::Tiles Widget 12-->
			                    </div>
			                    <div class="col-md-4">
			                        <!--begin::Tiles Widget 12-->
			                        <a href="#">
										<div class="card card-custom gutter-b" style="height: 150px">
										    <div class="card-body">
										        <span class="svg-icon svg-icon-primary svg-icon-2x">
										        	<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo5/dist/../src/media/svg/icons/General/Duplicate.svg-->
										        	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"/>
													        <path d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
													        <path d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z" fill="#000000"/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												<span class="svg-icon svg-icon-primary svg-icon-2x float-right">
													<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Angle-double-right.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <polygon points="0 0 24 0 24 24 0 24"/>
													        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"/>
													        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
										        <div class="text-dark font-weight-bolder font-size-h2 mt-3">Others</div>
										        <span class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1"><small>Submit Other</small></span>
										    </div>
										</div>
									</a>
									<!--end::Tiles Widget 12-->
			                    </div>
			                </div>
						</div>
						<!--end::Container-->
					</div>
					<!--end::Entry-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				@include("layouts.backend.{{ getAccountType() }}.footer-content")
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Main-->
	<!-- Footer -->
	@include("layouts.backend.{{ getAccountType() }}.footer")
</body>
<!--end::Body-->
</html>
