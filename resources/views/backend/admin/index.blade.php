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

                <div class="col-lg-3 my-5">
                    <div class="dashboard-card">
                        <p>All Cases</p>
                        <span>{{ $cases->submittedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @if(in_array(\Auth::user()->account_type, ['AD']))
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('dashboard.users') }}';">
                    <div class="dashboard-card purple">
                        <p>Users</p>
                        <span>{{ \App\Models\User::where('status', 'active')->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('faq.faqs') }}';">
                    <div class="dashboard-card blue">
                        <p>FAQs</p>
                        <span>{{ \App\Models\Faq::all()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @endif
                @if(in_array(\Auth::user()->account_type, ['SP']))
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.unassigned') }}';">
                    <div class="dashboard-card purple">
                        <p>New Cases</p>
                        <span>{{ $cases->unassignedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @endif
                @if(!in_array(\Auth::user()->account_type, ['AD']))
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.assigned') }}';">
                    <div class="dashboard-card blue">
                        <p>Assigned Cases</p>
                        @if(in_array(\Auth::user()->account_type, ['CH']))
                         <span>{{ \Auth::user()->active_cases_assigned_to()->count() }}</span>
                        @else
                            <span>{{ $cases->assignedCases()->count() }}</span>
                        @endif
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5"  onclick="window.location.href = '{{ route('cases.working_on') }}';">
                    <div class="dashboard-card orange">
                        <p>Ongoing</p>
                        <span>{{ \Auth::user()->cases_working_on()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.on-hold') }}';">
                    <div class="dashboard-card redish-orange">
                        <p>On Hold</p>
                         <span>{{ \Auth::user()->deficientCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @endif
			</div>	
			<div class="row mt-10">
				<div class="col-lg-6">
					<div class="card card-custom bg-gray-100 card-stretch gutter-b">
						<div class="card-header h-auto border-0">
							<div class="card-title py-5">
								<h3 class="card-label">
									<span class="d-block text-dark font-weight-bolder">Transactions Over Time</span>
								</h3>
							</div>
							<div class="card-toolbar">
								<ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist">
									<li class="nav-item">
										<a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_1">
											<span class="nav-text font-size-sm">Local</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_2">
											<span class="nav-text font-size-sm">FFM</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_3">
											<span class="nav-text font-size-sm">FFM Exp</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="card-body">
							<div id="kt_charts_widget_2_chart"></div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
