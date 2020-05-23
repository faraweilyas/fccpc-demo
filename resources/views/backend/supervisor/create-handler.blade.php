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
				<h5 class="text-dark font-weight-bold my-2 mr-5">New Case Handler</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">New Case Handler</a>
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
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
							<h3 class="card-title">Case Handler Information</h3>
						</div>
						<form>
							<div class="card-body">
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<label>Full Name</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" placeholder="Enter full name" name="fullName">
											<span class="form-text text-muted">Please enter full name.</span>
										</div>
										<div class="form-group">
											<label>Email</label> <span class="text-danger">*</span>
											<input type="eamil" class="form-control" placeholder="Enter email" name="email">
											<span class="form-text text-muted">Please enter email.</span>
										</div>
										<div class="form-group">
											<label>Phone No</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" placeholder="Enter phone no" name="phone">
											<span class="form-text text-muted">Please enter phone no.</span>
										</div>
										<div class="form-group">
											<label>Sex</label>
											<div class="radio-inline">
												<label class="radio">
													<input type="radio" name="gender" checked="checked">Male<span></span>
												</label>
												<label class="radio">
													<input type="radio" name="gender">Female<span></span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7 text-right">
										<button type="submit" class="btn btn-primary mr-2"><i class="la la-cloud-upload"></i> Create Handler</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
@endSection