@extends('layouts.backend.'.getAccountType().'.base')
@section('content')
<!--begin::Content-->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-2 mr-5">Case Review</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Assigned Cases</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Review Case</a>
					</li>
				</ul>
				<!--end::Page Title-->
			</div>
			<!--end::Page Heading-->
		</div>
		<!--end::Info-->
	</div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row mt-4">
				<div class="col-md-6">
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
							<h3 class="card-title">Case Information</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<p>
										<strong>Ref No :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-primary text-dark label-inline">FCCPC/BC/M&A/00/20/VOLNo</span>
									</p>
									<p>
										<strong>Subject :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">M&A Case Management System</span>
									</p>
									<p>
										<strong>Case Type :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-info text-dark label-inline">Application</span>
									</p>
									<p>
										<strong>Parties : </strong>&nbsp;Techbarn, FCCPC
									</p>
									<p>
										<strong>Case Rep :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">T&A Legal</span>
									</p>
									<p>
										<strong>Category :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-info text-dark label-inline">FFM</span>
									</p>
									<p>
										<strong>Case Handler : </strong>&nbsp;Yemisi
									</p>
									<p>
										<strong>Status :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">On Hold</span>
									</p>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-12">
									<h4 class="text-bold font-weight-bolder text-dark">Recommendation</h4>
									<p>...</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group mb-1">
								<textarea class="form-control" id="exampleTextarea" rows="6">Make comments to case handler...</textarea>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title">Actions</h3>
									<span class="float-right mt-5"><button type="button" class="btn btn-success mr-2"><i class="la la-arrow-alt-circle-down"></i>&nbsp;View evidence</button></span>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-primary mr-2">Approve recommendation</button>
											</p>
										</div>
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-danger mr-2">Reject recommendation</button>
											</p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#reassignCaseModal">Reassign recommendation</button>
											</p>
										</div>
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#issueQueryModal">Query recommendation</button>
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
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<!-- Modal-->
<div class="modal fade" id="reassignCaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reassign case to case handler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <!--begin::Input-->
                <div class="row">
                	<div class="col-md-6">
                		<div class="row">
							<div class="col-md-12">
								<label>Subject</label>
								<input type="text" class="form-control" value="M&A Case Management System" disabled>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-md-12">
								<label>Remove case handler</label>
								<input type="text" class="form-control" value="Morayo" disabled>
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
                	<div class="col-md-6 mt-sm-10">
                		<div class="row">
							<div class="col-md-12">
								<label>Reason</label>
								<textarea class="form-control" id="exampleTextarea" rows="6">Reason...</textarea>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Reassign</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="issueQueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reassign case to case handler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <!--begin::Input-->
                <div class="row">
                	<div class="col-md-6">
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
                	<div class="col-md-6">
                		<div class="row">
							<div class="col-md-12">
								<label>Query</label>
								<textarea class="form-control" id="exampleTextarea" rows="6">Query...</textarea>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Issue Query</button>
            </div>
        </div>
    </div>
</div>
@endSection
<script src="{{ BE_JS.'pages/crud/forms/widgets/select2.js' }}"></script>