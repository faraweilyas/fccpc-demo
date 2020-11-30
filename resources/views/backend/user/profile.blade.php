@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Profile</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.user_detail') }}" class="text-muted">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container">
            <div class="row">
                <div class="col-md-5">

                    <div class="card__box card__box-stack shadow card__box-stack-active align__center" id="edit-profile-control">
                        <section class="card__box-stack-img">
                            <x-icons.user-profile></x-icons.user-profile>
                        </section>
                        <div class="card__box--content">
                            <p>Personal Information</p>
                        </div>
                    </div>

                    <div class="card__box card__box-stack shadow align__center" id="change-password-control">
                        <section class="card__box-stack-img">
                            <x-icons.open-book></x-icons.open-book>
                        </section>
                        <div class="card__box--content">
                            <p>Change Password</p>
                        </div>
                    </div>

                </div>

                <div id="edit-profile-card" class="col-md-7 my-5">
                    <form method="POST" action="{{ route('dashboard.update_user_profile') }}">
                        @csrf
                        <div class="card card__box__large">
                            <div class="card__box__large-content">
                                <h4>Edit your personal details</h4>
                                <div class="form-group form-group-profile">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control-profile" name="first_name" value="{{ $user->first_name }}" required />
                                </div>

                                <div class="form-group form-group-profile">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control-profile" name="last_name" value="{{ $user->last_name }}" required />
                                </div>

                                <span class="form-subtitle my-5 py-5">CONTACT INFORMATION</span>

                                <div class="form-group form-group-profile">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control-profile" name="phone_number" value="{{ $user->phone_number ?? '' }}">
                                </div>

                                <div class="form-group form-group-profile">
                                    <label for="">Email Address</label>
                                    <input type="text" class="form-control-profile" name="email" value="{{ $user->email }}" disabled>
                                </div>

                                <div class="form-group form-group-profile">
                                    <label for="">Home Address</label>
                                    <textarea class="form-control form-control-textarea" cols="50" name="address">{{ $user->address ?? '' }}</textarea>
                                </div>
                                <div class="d-flex">
                                    {{-- <button class="btn btn-success formBtn-success-light">Cancel</button> --}}
                                    <button type="submit" class="btn btn-success btn-block formBtn-success">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="change-password-card" class="col-md-7 my-5 hide">
                    <form method="POST" action="{{ route('dashboard.update_user_profile') }}">
                        @csrf
                        <div class="card card__box__large">
                            <div class="card__box__large-content">
                                <h4>Change your password</h4>
                                <div class="form-group form-group-profile">
                                    <label for="">Old Password</label>
                                    <input type="password" name="password" class="form-control-profile" required />
                                </div>

                                <div class="form-group form-group-profile">
                                    <label for="">New Password</label>
                                    <input type="password" name="new_password" class="form-control-profile" required />
                                </div>

                                <div class="form-group form-group-profile">
                                    <label for="">Confirm New Password</label>
                                    <input type="password" class="form-control-profile" name="password_confirmation" required />
                                </div>
                                <div class="d-flex">
                                    {{-- <button class="btn btn-success formBtn-success-light">Cancel</button> --}}
                                    <button class="btn btn-success btn-block formBtn-success">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_JS.'jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'update-profile.js') }}"></script>
@endsection
