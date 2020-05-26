@extends('layouts.backend.base')
@section('content')
<!--begin::Content-->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-2 mr-5">New User</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">New User</a>
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
							<h3 class="card-title">Create New User</h3>
						</div>
						<form method="POST" action="{{ route('dashboard.user_store') }}">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<label>First Name</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" placeholder="Enter first name" name="firstName">
											<span class="form-text text-muted">Please enter first name.</span>
											@error('firstName')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
				                            @enderror
										</div>
										<div class="form-group">
											<label>Last Name</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" placeholder="Enter last name" name="lastName">
											<span class="form-text text-muted">Please enter last name.</span>
											@error('lastName')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
				                            @enderror
										</div>
										<div class="form-group">
											<label>Email</label> <span class="text-danger">*</span>
											<input type="email" class="form-control" placeholder="Enter email" name="email">
											<span class="form-text text-muted">Please enter email.</span>
											@error('email')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
				                            @enderror
										</div>
										<div class="form-group">
											<label>Account Type</label> <span class="text-danger">*</span>
											<select class="form-control selectpicker" name="accountType">
												<option value="">Select account type</option>
												 @foreach(\App\Enhancers\AppHelper::$account_types as $key => $value)
												 <option value="{{ $key }}">{{ strtoupper($value) }}</option>
												 @endforeach
											</select>
											<span class="form-text text-muted">Please select account type.</span>
											@error('accountType')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
				                            @enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7 text-right">
										<button type="submit" class="btn btn-primary mr-2"><i class="la la-cloud-upload"></i> Create User</button>
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