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
                        <a href="" class="text-muted">Profile</a>
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

                <div class="card__box card__box-stack shadow card__box-stack-active" id="control-1">
                    <section class="card__box-stack-img">
                        <x-icons.user-profile></x-icons.user-profile>
                    </section>
                    <div class="card__box--content">
                        <p>Personal Information</p>
                        <span>Edit your personal details</span>
                    </div>
                </div>

                <div class="card__box card__box-stack shadow " id="control-1">
                    <section class="card__box-stack-img">
                        <x-icons.open-book></x-icons.open-book>
                    </section>
                    <div class="card__box--content">
                        <p>Change Password</p>
                        <span>Change your password</span>
                    </div>
                </div>

            </div>

            <div class="col-md-7 my-5">
                <div class="card card__box__large">
                    <div class="card__box__large-content">
                        {{--  --}}
                        <div class="form-group form-group-profile">
                            <label for="">First Name</label>
                            <input type="text" class="form-control-profile">
                        </div>

                        <div class="form-group form-group-profile">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control-profile">
                        </div>

                        <span class="form-subtitle my-5 py-5">CONTACT INFORMATION</span>

                        <div class="form-group form-group-profile">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control-profile">
                        </div>

                        <div class="form-group form-group-profile">
                            <label for="">Email Address</label>
                            <input type="text" class="form-control-profile">
                        </div>

                        <div class="form-group form-group-profile">
                            <label for="">Home Address</label>
                            <textarea class="form-control form-control-textarea" cols="50"></textarea>
                        </div>

                        <div class="d-flex">
                            <button class="btn btn-success formBtn-success-light">Cancel</button>
                            <button class="btn btn-success btn-block formBtn-success">Save Changes</button>
                        </div>

                        {{--  --}}
                    </div>
                    
                </div>
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
