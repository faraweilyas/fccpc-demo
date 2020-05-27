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
				<h5 class="text-dark font-weight-bold my-2 mr-5">{{ $case }}</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">{{ $case }}</a>
					</li>
				</ul>
				<!--end::Page Title-->
			</div>
			<!--end::Page Heading-->
		</div>
		<!--end::Info-->
	</div>
</div>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap py-5">
					<div class="card-title">
						<h3 class="card-label">{{ $case }}</h3>
					</div>
					
				</div>
				<div class="card-body">
					<!--begin: Datatable-->
					@if($type == 'new')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Transaction Type</th>
								<th>Subject</th>
								<th>Parties</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach(\App\Models\Cases::where('status', 1)->get() as $case)
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
								</td>
								<td><span class="label label-lg font-weight-bold label-light-info label-inline">{{ ucwords($case->subject) }}</span></td>
								<td>
									{{ $case->parties }}
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">{{ \App\Enhancers\AppHelper::$case_categories[$case->transaction_category] }}</span>
								</td>
								<td>
									<a href="javascript:;" class="btn btn-sm btn-icon" title="Edit details" data-toggle="modal" data-target="#assignCaseModal{{ $case->id }}">
										<i class="la la-edit"></i>Assign
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@elseif ($type == 'assigned')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Transaction Type</th>
								<th>Subject</th>
								<th>Case Handler</th>
								<th>Status</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach(\App\Models\Cases::where('status', 2)->get() as $case)
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
								</td>
								<td>{{ ucwords($case->subject) }}</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-success text-dark label-inline">{{ \App\User::find($case->case_handler_id)->getFullName() }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-{{ \App\Enhancers\AppHelper::$case_statusHTML[$case->status]}} text-dark label-inline">{{ \App\Enhancers\AppHelper::$case_status[$case->status]}}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-info text-dark label-inline">{{ \App\Enhancers\AppHelper::$case_categories[$case->transaction_category] }}</span>
								</td>
								<td>
									<a href="{{ route('cases.review', ['id' => $case->id]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
										<i class="la la-info-circle"></i>&nbsp;&nbsp;Review
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@elseif ($type == 'hold')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Transaction Type</th>
								<th>Subject</th>
								<th>Case Handler</th>
								<th>Status</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach(\App\Models\Cases::where('status', 3)->get() as $case)
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
								</td>
								<td>{{ ucwords($case->subject) }}</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-success text-dark label-inline">{{ \App\User::find($case->case_handler_id)->getFullName() }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-{{ \App\Enhancers\AppHelper::$case_statusHTML[$case->status]}} text-dark label-inline">{{ \App\Enhancers\AppHelper::$case_status[$case->status]}}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-info text-dark label-inline">{{ \App\Enhancers\AppHelper::$case_categories[$case->transaction_category] }}</span>
								</td>
								<td>
									<a href="{{ route('cases.review', ['id' => $case->id]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
										<i class="la la-info-circle"></i>&nbsp;&nbsp;Review
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@elseif($type == 'approved')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Transaction Type</th>
								<th>Subject</th>
								<th>Parties</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach(\App\Models\Cases::where('status', 4)->get() as $case)
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
								</td>
								<td><span class="label label-lg font-weight-bold label-light-info label-inline">{{ ucwords($case->subject) }}</span></td>
								<td>
									{{ $case->parties }}
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">{{ \App\Enhancers\AppHelper::$case_categories[$case->transaction_category] }}</span>
								</td>
								<td>
									<a href="{{ route('cases.review', ['id' => $case->id]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
										<i class="la la-info-circle"></i>&nbsp;&nbsp;Review
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@endif
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<!-- Modal-->
@foreach(\App\Models\Cases::whereIn('status', array(1,2,3,4))->get() as $case)
<div class="modal fade" id="assignCaseModal{{$case->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign case handler to case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('cases.assign', ['id' => $case->id]) }}">
            	@csrf
	            <div class="modal-body">
	                <!--begin::Input-->
					<div class="row">
						<div class="col-md-12">
							<label>Subject</label>
							<input type="text" class="form-control" value="{{ ucfirst($case->subject) }}" disabled>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-md-12">
							<label>Select case handler</label><br>
							<select class="form-control select2" id="kt_select2_1" name="case_handler" style="width: 100%;">
								<option value="">Select Case Handler</option>
								@foreach(\App\User::where('status', 1)->where('accountType', 'CH')->get() as $handler)
									<option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
								@endforeach
							</select>
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary font-weight-bold">Assign</button>
	            </div>
	        </form>
        </div>
    </div>
</div>
@endforeach
@endSection('content')
