@extends('layouts.backend.base-login')
@section('content')
	<div class="d-flex flex-column flex-root">
		<div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
			<div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
				<span class="font-weight-bold text-dark-50">Do you need help?</span>
				<a href="{{ route('home.faqs') }}" class="font-weight-bold ml-2" id="kt_login_signup">FAQ</a> |
				<a href="{{ route('home.calculator') }}" class="font-weight-bold ml-2" id="kt_login_signup">Fee Calculator</a>
			</div>
			<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }}">
				<div class="login-form text-center p-7 position-relative overflow-hidden">
					<div class="d-flex flex-center mb_15">
						<a href="{{ route('home.index') }}">
							<img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
						</a>
					</div>
					<div class="login-signin">
						<div class="mb_30">
							<h3>Submit Application</h3>
							<div class="text-muted font-weight-bold">Enter your email to submit your application:</div>
						</div>
						<form class="form" method="POST" action="{{ route('applicant.authenticate') }}">
							@csrf
							<div class="form-group mb-5">
                                @error('email')
                                    <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
								<input type="email" placeholder="Email address:" name="email" class="form-control h-auto form-control-solid py-4 px-8" autocomplete="off" />
							</div>
							<button id="kt_login_signin_submit" type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
						</form>
						<div class="mt-10">
                            <p>
                                <span class="opacity-70">Existing application?</span><br />
                                <a href="{{ route('applicant.track') }}" id="kt_login_signup2" class="text-muted text-hover-primary font-weight-bold">Add supporting documents or continue where you left off</a>
                            </p>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endSection
