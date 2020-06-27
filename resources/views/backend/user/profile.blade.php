@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline mr-5">
				<h5 class="text-dark font-weight-bold my-2 mr-5">User Profile</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Profile</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
							<h3 class="card-title">Update User Profile</h3>
						</div>
						<form method="POST" action="{{ route('dashboard.update_user') }}">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Account Type</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" value="{{ $user->getAccountType() }}" disabled />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label> <span class="text-danger">*</span>
											<input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ $user->email ?? '' }}">
											<span class="form-text text-muted">Please enter email.</span>
											@error('email')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
				                            @enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" placeholder="Enter first name" name="first_name" value="{{ $user->getFirstName() }}">
											<span class="form-text text-muted">Please enter first name.</span>
											@error('first_name')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
				                            @enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name</label> <span class="text-danger">*</span>
											<input type="text" class="form-control" placeholder="Enter last name" name="last_name" value="{{ $user->getLastName() }}">
											<span class="form-text text-muted">Please enter last name.</span>
											@error('last_name')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
				                            @enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Change Password?</label>
											<div class="radio-inline">
												<label class="radio">
												<input type="radio" name="change_pass" value="yes">Yes
												<span></span></label>

												<label class="radio">
												<input type="radio" name="change_pass" value="no" checked="checked">No
												<span></span></label>
											</div>
										</div>
									</div>
								</div>
								<div id="change-password" class="hide">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Old Password <span class="text-danger">*</span></label>
												<input type="password" class="hide" />
												<input type="password" class="form-control" placeholder="password" name="password" />
												<span class="form-text text-muted">Provide password.</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>New Password <span class="text-danger">*</span></label>
												<input type="password" class="form-control" placeholder="password" name="new_password"/>
												<span class="form-text text-muted">Provide password.</span>

											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Retype New Password <span class="text-danger">*</span></label>
												<input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation"/>
												<span class="form-text text-muted">Provide password.</span>
											</div>
											@error('password')
				                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
				                            @enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-7 text-right">
										<button type="submit" class="btn btn-primary mr-2"><i class="la la-cloud-upload"></i> Update User</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ pc_asset(BE_JS.'jquery.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_JS.'update-profile.js') }}"></script>
@endSection
