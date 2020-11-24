@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">User Details</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">User Details</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="row">

            <div class="col-md-12 my-5">
                <div class="card card__box__large">
                    <div class="card__box__large-content">


                        <div class="row">
                            <div class="col-md-4">
                              <div class="profile-image">
                                OI
                              </div>
                            </div>

                            <div class="col-md-8 ">

                                <div class="content-box">
                                    <span>Account Type</span>
                                    <p>Administrator</p>
                                </div>

                                <div class="content-box">
                                    <span>First Name</span>
                                    <p>Osamudiamen Imaseun</p>
                                </div>


                                <div class="content-box ">
                                    <span>Last Name</span>
                                    <p>Osamudiamen Imaseun</p>
                                </div>

                                <div class="content-box ">
                                    <span>Email Address</span>
                                    <p>Osamudiamen@gmail.com</p>
                                </div>

                                <div class="content-box ">
                                    <span>Phone Number</span>
                                    <p>+234 000 0000 000</p>
                                </div>

                                <div class="content-box ">
                                    <span>Address</span>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Itaque fugiat qui expedita quidem, repudiandae placeat iure incidunt deleniti
                                        praesentium dolorem recusandae.
                                        Deserunt, nihil quas nemo maiores cupiditate perspiciatis dolore aspernatur.
                                    </p>
                                </div>
                                <div class="content-box ">
                                    <span>Status</span>
                                    <p class="label-success my-5">
                                      Active
                                    </p>
                                    <p class="label-danger my-5">
                                      In-active
                                    </p>
                                </div>

                            </div>

                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
