@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">M&A Case Management</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Home</a>
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

                <div class="col-lg-3">
                    <div class="dashboard-card">
                        <p>All Cases</p>
                        <span>{{ $cases->submittedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="dashboard-card purple">
                        <p>UnAssigned Cases</p>
                        <span>{{ $cases->unassignedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="dashboard-card blue">
                        <p>Assigned Cases</p>
                        <span>{{ $cases->assignedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="dashboard-card orange">
                        <p>Exceeded Timeline</p>
                        <span>53</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>

                <div class="col-lg-3 my-4">
                    <div class="dashboard-card redish-orange">
                        <p>Deficiencies</p>
                        <span>53</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
