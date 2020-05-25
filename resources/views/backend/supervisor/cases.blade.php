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
								<th>Case Type</th>
								<th>Subject</th>
								<th>Fees Paid</th>
								<th>Parties</th>
								<th>Case Rep</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">FCCPC/BC/M&A/00/20/VOLNo</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">Application</span>
								</td>
								<td>M&A Case Management System</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-success text-dark label-inline">Yes</span>
								</td>
								<td>T&A Legal</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">Regular</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-info label-inline">FFM</span>
								</td>
								<td>
									<a href="javascript:;" class="btn btn-sm btn-icon" title="Edit details" data-toggle="modal" data-target="#assignCaseModal">
										<i class="la la-edit"></i>Assign
									</a>
								</td>
							</tr>
						</tbody>
					</table>
					@elseif ($type == 'assigned' || $type == 'hold')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Case Type</th>
								@if($type == 'hold')
								<th>Reason</th>
								@endif
								<th>Subject</th>
								<th>Case Handler</th>
								<th>Status</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">FCCPC/BC/M&A/00/20/VOLNo</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">Application</span>
								</td>
								<td>M&A Case Management System</td>
								@if($type == 'hold')
								<td>Lack of evidence</td>
								@endif
								<td>
									<span class="label label-lg font-weight-bold label-light-success text-dark label-inline">Yemisi</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">On Hold</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-info label-inline">FFM</span>
								</td>
								<td>
									<a href="{{ route('cases.review', ['id' => 23]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
										<i class="la la-arrow-alt-circle-down"></i>&nbsp;&nbsp;Review
									</a>
								</td>
							</tr>
						</tbody>
					</table>
					@elseif($type == 'requests')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Reason</th>
								<th>Subject</th>
								<th>Case Handler</th>
								<th>Request Type</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">FCCPC/BC/M&A/00/20/VOLNo</span>
								</td>
								<td>Lack of evidence</td>
								<td>M&A Case Management System</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-success text-dark label-inline">Yemisi</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">Extension</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-info label-inline">FFM</span>
								</td>
								<td>
									<a href="#" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
										<i class="la la-check"></i>&nbsp;&nbsp;Approve
									</a>
								</td>
							</tr>
						</tbody>
					</table>
					@elseif($type == 'approved')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Ref No</th>
								<th>Case Type</th>
								<th>Subject</th>
								<th>Parties</th>
								<th>Case Handler</th>
								<th>Category</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">FCCPC/BC/M&A/00/20/VOLNo</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">Application</span>
								</td>
								<td>M&A Case Management System</td>
								<td>Techbarn, FCCPC</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">Morayo</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-info label-inline">FFM</span>
								</td>
								<td>
									<a href="#" class="btn btn-sm btn-icon text-hover-primary" title="Edit details">
										<i class="la la-check"></i>&nbsp;&nbsp;Publish
									</a>
								</td>
							</tr>
						</tbody>
					</table>
					@elseif($type == 'filter')
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th title="Field #1">Ref No</th>
								<th title="Field #2">Case Type</th>
								<th title="Field #3">Subject</th>
								<th title="Field #4">Parties</th>
								<th title="Field #5">Case Rep</th>
								<th title="Field #6">Category</th>
								<th title="Field #7">Case Handler</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<span class="label label-lg font-weight-bold label-light-primary label-inline">FCCPC/BC/M&A/00/20/VOLNo</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">Application</span>
								</td>
								<td>M&A Case Management System</td>
								<td>Techbarn, FCCPC</td>
								<td>T&A Legal</td>
								<td><span class="label label-lg font-weight-bold label-light-info label-inline">FFM</span></td>
								<td><span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">Morayo</span></td>
							</tr>
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
<div class="modal fade" id="assignCaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign case handler to case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <!--begin::Input-->
				<div class="row">
					<div class="col-md-12">
						<label>Subject</label>
						<input type="text" class="form-control" value="M&A Case Management System" disabled>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-md-12">
						<label>Select case handler</label><br>
						<select class="form-control select2" id="kt_select2_1" name="case_handlers" style="width: 100%;">
							<option value="JD">Florence</option>
							<option value="JJ">Yemisi</option>
						</select>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Assign</button>
            </div>
        </div>
    </div>
</div>
@endSection('content')
