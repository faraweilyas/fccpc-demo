@extends('layouts.backend.'.getAccountType().'.base')
@section('content')
<!--begin::Content-->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="sub-header-desktop">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-2 mr-5">{{ $case }} Application Case</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('applicant.index', ['id' => $id]) }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Application</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">{{ $case }} Transaction</a>
					</li>
				</ul>
				<!--end::Page Title-->
			</div>
			<!--end::Page Heading-->
		</div>
		<div class="sub-header-mobile">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-2 mr-5">{{ $case }} Application Case</h5>
				
				<!--end::Page Title-->
			</div>
			<div class="d-flex align-items-baseline mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Application</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">{{ $case }} Transaction</a>
					</li>
				</ul>
			</div>
			<!--end::Page Heading-->
		</div>
		<!--end::Info-->
	</div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div class="container">
		<div class="card card-custom">
			<div class="card-body p-0">
				<!--begin: Wizard-->
				<div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="false">
					<!--begin: Wizard Nav-->
					<div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
						<!--begin::Wizard Step 1 Nav-->
						<div class="wizard-steps">
							<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
								<div class="wizard-wrapper">
									<div class="wizard-icon">
										<span class="svg-icon svg-icon-2x">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Map/Compass.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
									<div class="wizard-label">
										<h3 class="wizard-title">Applicant Case Information</h3>
										<div class="wizard-desc">Provide your case details</div>
									</div>
								</div>
							</div>
							<!--end::Wizard Step 1 Nav-->
							<!--begin::Wizard Step 2 Nav-->
							<div class="wizard-step" data-wizard-type="step">
								<div class="wizard-wrapper">
									<div class="wizard-icon">
										<span class="svg-icon svg-icon-2x">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
									<div class="wizard-label">
										<h3 class="wizard-title">Contact Information</h3>
										<div class="wizard-desc">Provide your contact details</div>
									</div>
								</div>
							</div>
							<!--end::Wizard Step 2 Nav-->
							<!--begin::Wizard Step 3 Nav-->
							<div class="wizard-step" data-wizard-type="step">
								<div class="wizard-wrapper">
									<div class="wizard-icon">
										<span class="svg-icon svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Home\Building.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
											        <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
											        <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
									<div class="wizard-label">
										<h3 class="wizard-title">Company Documents</h3>
										<div class="wizard-desc">Provide your company documents</div>
									</div>
								</div>
							</div>
							<!--end::Wizard Step 3 Nav-->
							<!--begin::Wizard Step 4 Nav-->
							<div class="wizard-step" data-wizard-type="step">
								<div class="wizard-wrapper">
									<div class="wizard-icon">
										<span class="svg-icon svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Communication\Clipboard-list.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
											        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
											        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
											        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
											        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
											        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
											        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
											        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
											    </g>
											</svg>
										<!--end::Svg Icon-->
										</span>
									</div>
									<div class="wizard-label">
										<h3 class="wizard-title">Account Documents</h3>
										<div class="wizard-desc">Provide your account documents</div>
									</div>
								</div>
							</div>
							<!--end::Wizard Step 4 Nav-->
							<!--begin::Wizard Step 5 Nav-->
							<div class="wizard-step" data-wizard-type="step">
								<div class="wizard-wrapper">
									<div class="wizard-icon">
										<span class="svg-icon svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Communication\Clipboard-check.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
											        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
											        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
									<div class="wizard-label">
										<h3 class="wizard-title">Payment Documents</h3>
										<div class="wizard-desc">Provide your payment documents</div>
									</div>
								</div>
							</div>
							<!--end::Wizard Step 5 Nav-->
							
						</div>
					</div>
					<!--end: Wizard Nav-->
					<!--begin: Wizard Body-->
					<div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
						<!--begin: Wizard Form-->
						<div class="row">
							<div class="offset-xxl-2 col-xxl-8">
								<form class="form new-case-form" id="kt_form" method="POST" enctype="multipart/form-data">
									<input type="hidden" id="case_id" name="case_id" value="{{ $case_info->id ?? 0 }}">
									<input type="hidden" id="tracking_id" name="tracking_id" value="{{ $case_info->tracking_id ?? $id }}">
									<input type="hidden" id="transaction_category" name="transaction_category" value="{{ $type ?? '' }}">
									<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
									<!--begin: Wizard Step 1-->
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
										<!--begin::Input-->
										<h4 class="mb-10 font-weight-bold text-dark">Enter your Case Details</h4>
										<div class="form-group fv-plugins-icon-container">
											<label>Subject</label> <span class="text-danger">*</span>
											<input type="text" id="subject" class="form-control" placeholder="Enter subject name" name="subject" value="{{ $case_info->subject ?? '' }}">
											<span class="form-text text-muted">Please enter subject.</span>
											<div class="fv-plugins-message-container"></div>
										</div>
										<div class="form-group">
											<label>Parties</label> <span class="text-danger">*</span>
											<div class="fields">
												@if(isset($case_party_arr) && is_array($case_party_arr) && $case_info->parties != '')
												<div class="field-item">
													<div class="row">
														@foreach ($case_party_arr as $key => $value)
														<div class="col-lg-5 mb-4">
															<input type="text" class="form-control" placeholder="Enter party name" name="party[]" value="{{ $value }}">
															<div class="d-md-none mb-2"></div>
														</div>
														@endforeach
													</div>
												</div>
												@else
												<div class="field-item">
													<div class="row">
														<div class="col-lg-5">
															<input type="text" class="form-control" placeholder="Enter party name" name="party[]">
															<div class="d-md-none mb-2"></div>
														</div>
														<div class="col-lg-5">
															<input type="text" class="form-control" placeholder="Enter party name" name="party[]">
															<div class="d-md-none mb-2"></div>
														</div>
													</div>
												</div>
												@endif
											</div>
											<div class="row mt-4">
												<div class="col-lg-12">
													<a href="javascript:;" id="add-party-fields">
														<span class="svg-icon svg-icon-primary svg-icon-2x">
															<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Code\Plus.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															        <rect x="0" y="0" width="24" height="24"/>
															        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
															        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
															    </g>
															</svg>
															<!--end::Svg Icon-->
														</span>
														<span class="text-primary">&nbsp;&nbsp;Add More</span>
													</a>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Transaction Type</label>
											@if ($case_info)
											<div class="radio-inline">
												<label class="radio">
													<input type="radio" name="transaction_type" {{ ($case_info->transaction_type == "small" && $case_info) ? 'checked="checked"' : '' }} value="small">Small<span></span>
													&nbsp;&nbsp;<i class="la la-info-circle text-hover-primary" data-toggle="tooltip" title="Transaction below 1 Million Naira"></i>
												</label>
												<label class="radio">
													<input type="radio" name="transaction_type" {{ ($case_info->transaction_type == "large") ? 'checked="checked"' : '' }} value="large">Large<span></span>
													&nbsp;&nbsp;<i class="la la-info-circle text-hover-primary" data-toggle="tooltip" title="Transaction above 1 Million Naira"></i>
												</label>
											</div>
											@else
											<div class="radio-inline">
												<label class="radio">
													<input type="radio" name="transaction_type" checked="checked" value="small">Small<span></span>
													&nbsp;&nbsp;<i class="la la-info-circle text-hover-primary" data-toggle="tooltip" title="Transaction below 1 Million Naira"></i>
												</label>
												<label class="radio">
													<input type="radio" name="transaction_type" value="large">Large<span></span>
													&nbsp;&nbsp;<i class="la la-info-circle text-hover-primary" data-toggle="tooltip" title="Transaction above 1 Million Naira"></i>
												</label>
											</div>
											@endif
										</div>
										<!--end::Input-->
									</div>
									<!--end: Wizard Step 1-->
									<!--begin: Wizard Step 2-->
									<div class="pb-5" data-wizard-type="step-content">
										<h4 class="mb-10 font-weight-bold text-dark">Provide your contact details</h4>
										<div class="row">
											<div class="col-xl-12">
												<!--begin::Input-->
												<div class="form-group fv-plugins-icon-container">
													<label>Applicant/Representing Firm</label> <span class="text-danger">*</span>
													<input type="text" class="form-control" placeholder="Enter applicant/representing firm" name="representingFirm" value="{{ $case_info->applicant_firm ?? '' }}">
													<span class="form-text text-muted">Please enter your representing firm.</span>
													<div class="fv-plugins-message-container"></div>
												</div>
												<div class="form-group">
													<label>Contact Person</label> <span class="text-danger">*</span>
													<div class="row">
														<div class="col-lg-6">
															<input type="text" class="form-control" placeholder="Enter first name" name="fName" value="{{ $case_info->applicant_first_name ?? '' }}">
														</div>
														<div class="col-lg-6">
															<input type="text" class="form-control" placeholder="Enter last name" name="lName" value="{{ $case_info->applicant_last_name ?? '' }}">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group fv-plugins-icon-container">
															<label>Email Address</label> <span class="text-danger">*</span>
															<input type="email" class="form-control" placeholder="Enter email address" name="email" value="{{ $case_info->applicant_email ?? '' }}">
															<span class="form-text text-muted">Please enter your email address.</span>
															<div class="fv-plugins-message-container"></div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group fv-plugins-icon-container">
															<label>Telephone No</label> <span class="text-danger">*</span>
															<input type="text" class="form-control" placeholder="Enter telephone no" name="phone" value="{{ $case_info->applicant_phone_no ?? '' }}">
															<span class="form-text text-muted">Please enter your phone no.</span>
															<div class="fv-plugins-message-container"></div>
														</div>
													</div>
												</div>
												<div class="form-group fv-plugins-icon-container">
													<label>Address</label> <span class="text-danger">*</span>
													<input type="text" class="form-control" placeholder="Enter address" name="address" value="{{ $case_info->applicant_address ?? '' }}">
													<span class="form-text text-muted">Please enter your address.</span>
													<div class="fv-plugins-message-container"></div>
												</div>
												<!--end::Input-->
											</div>
										</div>
									</div>
									<!--end: Wizard Step 2-->
									<!--begin: Wizard Step 3-->
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
										<!--begin::Input-->
										<div class="row mt-4">
											<div class="col-md-12">
												<div class="card card-custom gutter-b example example-compact">
													<div class="card-header">
														<h3 class="card-title">Submit Company Documents</h3>
													</div>
													<div class="card-body">
														<p>
															Kindly upload company document. Kindly check boxes of documents being submitted and in cases where document is not available, please state in additional information section.
														</p>
														<p>
															Upload a single pdf file containing the following.
														</p>
														<div class="row mt-4">
															<div class="col-md-4">
																<div class="row">
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Document
																		</label>
																	</div>
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Form 7
																		</label>
																	</div>
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Form 2
																		</label>
																	</div>
																	<div class="col-md-12 mb-4">
																		<div class="uploadButton tw-mb-4">
								                                       	   <input accept=".doc, .docx, .pdf" id="company_doc" class="js-file-upload-input ember-view" type="file" name="company_doc">
								                                            <span class="btn btn--small btn--brand">Upload File</span>
								                                        </div>
																	</div>
																</div>
															</div>
															<div class="col-md-8">
																<div class="col-md-12">
																	<div class="form-group mb-1">
																		<textarea class="form-control" id="additional_info" rows="6" name="additional_company_doc_info">Additional Information...</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end: Wizard Step 3-->
									<!--begin: Wizard Step 4-->
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
										<!--begin::Input-->
										<div class="row mt-4">
											<div class="col-md-12">
												<div class="card card-custom gutter-b example example-compact">
													<div class="card-header">
														<h3 class="card-title">Submit Account Documents</h3>
													</div>
													<div class="card-body">
														<p>
															Kindly upload account document. Kindly check boxes of documents being submitted and in cases where document is not available, please state in additional information section.
														</p>
														<p>
															Upload a single pdf file containing the following.
														</p>
														<div class="row mt-4">
															<div class="col-md-4">
																<div class="row">
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Document
																		</label>
																	</div>
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Form 7
																		</label>
																	</div>
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Form 2
																		</label>
																	</div>
																	<div class="col-md-12 mb-4">
																		<div class="uploadButton tw-mb-4">
								                                       	   <input accept=".doc, .docx, .pdf" id="account_doc" class="js-file-upload-input ember-view" type="file" name="account_doc">
								                                            <span class="btn btn--small btn--brand">Upload File</span>
								                                        </div>
																	</div>
																</div>
															</div>
															<div class="col-md-8">
																<div class="col-md-12">
																	<div class="form-group mb-1">
																		<textarea class="form-control" id="additional_info" rows="6" name="additional_account_doc_info">Additional Information...</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end: Wizard Step 4-->
									<!--begin: Wizard Step 5-->
									<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
										<!--begin::Input-->
										<div class="row mt-4">
											<div class="col-md-12">
												<div class="card card-custom gutter-b example example-compact">
													<div class="card-header">
														<h3 class="card-title">Submit Payment Documents</h3>
													</div>
													<div class="card-body">
														<p>
															Kindly upload payment document. Kindly check boxes of documents being submitted and in cases where document is not available, please state in additional information section.
														</p>
														<p>
															Upload a single pdf file containing the following.
														</p>
														<div class="row mt-4">
															<div class="col-md-4">
																<div class="row">
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Document
																		</label>
																	</div>
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Form 7
																		</label>
																	</div>
																	<div class="col-md-12">
																		<label class="checkbox mb-4">
																			<input type="checkbox">
																			<span></span>CAC Form 2
																		</label>
																	</div>
																	<div class="col-md-12 mb-4">
																		<div class="uploadButton tw-mb-4">
								                                       	   <input accept=".doc, .docx, .pdf" id="payment_doc" class="js-file-upload-input ember-view" type="file" name="payment_doc">
								                                            <span class="btn btn--small btn--brand">Upload File</span>
								                                        </div>
																	</div>
																</div>
															</div>
															<div class="col-md-8">
																<div class="col-md-12">
																	<div class="form-group mb-1">
																		<textarea class="form-control" id="additional_info" rows="6" name="additional_payment_doc_info">Additional Information...</textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end: Wizard Step 5-->
									<!--begin: Wizard Actions-->
									<div class="d-flex justify-content-between border-top mt-5 pt-10">
										<div id="upload-img" class="hide">
											<button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" disabled><i class="fas fa-spinner fa-pulse"></i>&nbsp;Uploading...</button>
										</div>
										<div id="previous-btn" class="mr-2">
											<button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
										</div>
										<div id="save-btns">
											<button id="upload-info" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Save & Upload Case Documents</button>
											<button id="save-info" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Save & Continue</button>
										</div>
									</div>
									<!--end: Wizard Actions-->
								</form>
							</div>
							<!--end: Wizard-->
						</div>
					</div>
					<!--end: Wizard Body-->
				</div>
				<!--end: Wizard-->
			</div>
		</div>
	</div>
	<!--end::Container-->
</div>
<!--end::Content-->
@endSection
<script src="{{ asset(BE_JS.'create-application.js') }}"></script>
