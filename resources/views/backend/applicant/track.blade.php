@extends('layouts.backend.base-login')
@section('content')
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
			<div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
				<span class="font-weight-bold text-dark-50">Do you need help?</span>
				<a href="{{ route('home.faq') }}" class="font-weight-bold ml-2" id="kt_login_signup">FAQ</a> |
				<a href="{{ route('home.calculator') }}" class="font-weight-bold ml-2" id="kt_login_signup">Fee Calculator</a>
			</div>
			<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }}">
				<div class="login-form text-center p-7 position-relative overflow-hidden">
					<!--begin::Login Header-->
					<div class="d-flex flex-center mb_15">
						<a href="{{ route('home.index') }}">
							<img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
						</a>
					</div>
					<!--end::Login Header-->
					<!--begin::Login Sign in form-->
					<div class="login-signin">
						<div class="mb_30">
							<h3>Track Application</h3>
							<div class="text-muted font-weight-bold">Enter your id to track your application:</div>
						</div>
						<form class="form" method="POST" action="{{ route('applicant.authenticate_track') }}">
							@csrf
							<div class="form-group mb-5">
								<input type="text" placeholder="Tracking Id:" name="tracking_id" class="form-control h-auto form-control-solid py-4 px-8" autocomplete="off" />
								@error('tracking_id')
									<span class="text-danger mt-4 float-left">*{{ $message }}</span>
								@enderror
							</div>
							<button id="kt_login_signin_submit" type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
						</form>
					</div>
					<!--end::Login Sign in form-->
				</div>
			</div>
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->
@endSection