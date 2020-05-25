@extends('layouts.backend.'.getAccountType().'.base')
@section('content')
<!--begin::Content-->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-2 mr-5">M&A Case Management</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Home</a>
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
				<div class="col-lg-3">
					<!--begin::Tiles Widget 11-->
					<div class="card card-custom bg-success gutter-b" style="height: 150px">
						<div class="card-body">
							<span class="svg-icon svg-icon-white svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Devices\Server.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <rect x="0" y="0" width="24" height="24"/>
								        <path d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z" fill="#000000" opacity="0.3"/>
								        <path d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z" fill="#000000"/>
								        <path d="M5,16 L19,16 C20.1045695,16 21,16.8954305 21,18 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,18 C3,16.8954305 3.8954305,16 5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 L11,18 Z M7,20 C7.55228475,20 8,19.5522847 8,19 C8,18.4477153 7.55228475,18 7,18 C6.44771525,18 6,18.4477153 6,19 C6,19.5522847 6.44771525,20 7,20 Z" fill="#000000"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">All Cases</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 11-->
				</div>
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom bg-warning gutter-b" style="height: 150px">
						<div class="card-body">
							<span class="svg-icon svg-icon-white svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\Deleted-file.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <path d="M10.5857864,13 L9.17157288,11.5857864 C8.78104858,11.1952621 8.78104858,10.5620972 9.17157288,10.1715729 C9.56209717,9.78104858 10.1952621,9.78104858 10.5857864,10.1715729 L12,11.5857864 L13.4142136,10.1715729 C13.8047379,9.78104858 14.4379028,9.78104858 14.8284271,10.1715729 C15.2189514,10.5620972 15.2189514,11.1952621 14.8284271,11.5857864 L13.4142136,13 L14.8284271,14.4142136 C15.2189514,14.8047379 15.2189514,15.4379028 14.8284271,15.8284271 C14.4379028,16.2189514 13.8047379,16.2189514 13.4142136,15.8284271 L12,14.4142136 L10.5857864,15.8284271 C10.1952621,16.2189514 9.56209717,16.2189514 9.17157288,15.8284271 C8.78104858,15.4379028 8.78104858,14.8047379 9.17157288,14.4142136 L10.5857864,13 Z" fill="#000000"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Unassigned Cases</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom bg-primary gutter-b" style="height: 150px">
						<div class="card-body">
							<span class="svg-icon svg-icon-white svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\File.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"/>
								        <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"/>
								    </g>
								</svg><!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Assigned Cases</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom bg-dark gutter-b" style="height: 150px;background-image: url({{ asset(BE_MEDIA.'svg/patterns/taieri.svg') }}">
						<div class="card-body">
							<span class="svg-icon svg-icon-white svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\File-cloud.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <path d="M8.63657261,15.4632487 C7.65328954,14.8436137 7,13.7480988 7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.263236,9 13.7219407,10.3038529 13.9645556,12 L15,12 C16.1045695,12 17,12.8954305 17,14 C17,15.1045695 16.1045695,16 15,16 L10,16 C9.47310652,16 8.99380073,15.7962529 8.63657261,15.4632487 Z" fill="#000000"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Expediated Cases</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom bg-secondary gutter-b" style="height: 150px">
						<div class="card-body">
							<span class="svg-icon svg-icon-dark svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\File-minus.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <rect fill="#000000" x="9" y="12" width="6" height="2" rx="1"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-dark font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-dark font-weight-bold font-size-lg mt-1">Pending Approval</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom bg-dark gutter-b" style="height: 150px;">
						<div class="card-body">
							<span class="svg-icon svg-icon-white svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\Media.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <path d="M10.782158,15.8052934 L15.1856088,12.7952868 C15.4135806,12.6394552 15.4720618,12.3283211 15.3162302,12.1003494 C15.2814587,12.0494808 15.2375842,12.0054775 15.1868178,11.970557 L10.783367,8.94156929 C10.5558531,8.78507001 10.2445489,8.84263875 10.0880496,9.07015268 C10.0307022,9.15352258 10,9.25233045 10,9.35351969 L10,15.392514 C10,15.6686564 10.2238576,15.892514 10.5,15.892514 C10.6006894,15.892514 10.699033,15.8621141 10.782158,15.8052934 Z" fill="#000000"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Exceeded Timeline</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom gutter-b" style="height: 150px">
						<div class="card-body">
							<span class="svg-icon svg-icon-primary svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\Protected-file.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <path d="M14.5,12 C15.0522847,12 15.5,12.4477153 15.5,13 L15.5,16 C15.5,16.5522847 15.0522847,17 14.5,17 L9.5,17 C8.94771525,17 8.5,16.5522847 8.5,16 L8.5,13 C8.5,12.4477153 8.94771525,12 9.5,12 L9.5,11.5 C9.5,10.1192881 10.6192881,9 12,9 C13.3807119,9 14.5,10.1192881 14.5,11.5 L14.5,12 Z M12,10 C11.1715729,10 10.5,10.6715729 10.5,11.5 L10.5,12 L13.5,12 L13.5,11.5 C13.5,10.6715729 12.8284271,10 12,10 Z" fill="#000000"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right"><div class="text-dark font-weight-bolder font-size-h2 mt-3">607</div></span>
							<div class="mt-14">
								<a href="#" class="text-muted font-weight-bold font-size-lg mt-1">Extension Requests</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
				<div class="col-lg-3">
					<!--begin::Tiles Widget 12-->
					<div class="card card-custom bg-danger gutter-b" style="height: 150px;">
						<div class="card-body">
							<span class="svg-icon svg-icon-white svg-icon-3x">
								<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\Compiled-file.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <polygon points="0 0 24 0 24 24 0 24"/>
								        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								        <rect fill="#000000" opacity="0.3" transform="translate(8.984240, 12.127098) rotate(-45.000000) translate(-8.984240, -12.127098) " x="7.41281179" y="10.5556689" width="3.14285714" height="3.14285714" rx="0.75"/>
								        <rect fill="#000000" opacity="0.3" transform="translate(15.269955, 12.127098) rotate(-45.000000) translate(-15.269955, -12.127098) " x="13.6985261" y="10.5556689" width="3.14285714" height="3.14285714" rx="0.75"/>
								        <rect fill="#000000" transform="translate(12.127098, 15.269955) rotate(-45.000000) translate(-12.127098, -15.269955) " x="10.5556689" y="13.6985261" width="3.14285714" height="3.14285714" rx="0.75"/>
								        <rect fill="#000000" transform="translate(12.127098, 8.984240) rotate(-45.000000) translate(-12.127098, -8.984240) " x="10.5556689" y="7.41281179" width="3.14285714" height="3.14285714" rx="0.75"/>
								    </g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<span class="float-right">
								<div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">607</div>
							</span>
							<div class="mt-14">
								<a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Deficiencies</a>
							</div>
						</div>
					</div>
					<!--end::Tiles Widget 12-->
				</div>
			</div>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
@endSection