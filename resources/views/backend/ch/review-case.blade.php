@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline mr-5">
				<h5 class="text-dark font-weight-bold my-2 mr-5">Case Review</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Assigned Cases</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Review Case</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
								<div class="col-md-12 p_mb_20">
									<p>
										<b>Ref No:&nbsp;</b>
                                        <b>{{ $case->getRefNO() }}</b>
									</p>
									<p>
										<b>Subject:&nbsp;</b>
                                        {{ $case->subject ?? '' }}
									</p>
                                    <p>
                                        <b>Parties:&nbsp;</b>
                                        {!! $case->generateCasePartiesBadge() !!}
                                    </p>
									<p>
										<b>Transaction Type:&nbsp;</b>
                                        {{ $case->getTransactionType() }}
									</p>
									<p>
										<b>Transaction Category:&nbsp;</b>
                                        {{ $case->getCaseCategory('strtoupper') }}
									</p>
									<p>
										<b>Status:&nbsp;</b>
                                        <span class="label label-lg font-weight-bold label-light-{{ $case->getCaseStatusHTML() }} text-dark label-inline">
                                            {{ $case->getCaseStatus('strtoupper') }}
                                        </span>
									</p>
                                    <p>
                                        <b>Case Handler:&nbsp;</b>
                                        <b>{{ $case->getCaseHandlerName() }}</b>
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
								<textarea class="form-control" id="exampleTextarea" rows="6" placeholder="Make comments to case handler..."></textarea>
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
											<form method="POST" action="{{ route('cases.update_status', ['status' => 4, 'id' => $case->id]) }}">
							            	@csrf
												<p>
													<button type="button" class="btn btn-primary mr-2">Approve recommendation</button>
												</p>
											</form>
										</div>
										<div class="col-md-6 text-center">
											<form method="POST" action="{{ route('cases.update_status', ['status' => 5, 'id' => $case->id]) }}">
							            	@csrf
												<p>
													<button type="button" class="btn btn-danger mr-2">Reject recommendation</button>
												</p>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#reassignCaseModal">Reassign Case</button>
											</p>
										</div>
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#issueQueryModal-none">Query recommendation</button>
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
</div>
<div class="modal fade" id="reassignCaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reassign case to case handler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('cases.assign', ['id' => $case->id]) }}">
            	@csrf
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-6">
	                		<div class="row">
								<div class="col-md-12">
									<label>Subject</label>
									<input type="text" class="form-control" value="{{ ucwords($case->subject) ?? '' }}" disabled>
								</div>
							</div>
							<div class="row mt-5">
								<div class="col-md-12">
									<label>Previous case handler</label>
									<input type="text" class="form-control" value="{{ $case->getCaseHandlerName() }}" disabled>
								</div>
							</div>
							<div class="row mt-5">
								<div class="col-md-12">
									<label>New case handler</label><br>
									<select class="form-control select2" id="case_handler" name="case_handler" style="width: 100%;">
										<option value="">Select Case Handler</option>
										@foreach(\App\User::where('status', 1)->where('accountType', 'CH')->get() as $handler)
											<option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
										@endforeach
									</select>
								</div>
							</div>
	                	</div>
	                	<div class="col-md-6 mt-sm-10">
	                		<div class="row">
								<div class="col-md-12">
									<label>Reason</label>
									<textarea class="form-control" id="exampleTextarea" rows="6" placeholder="Reason..."></textarea>
								</div>
							</div>
						</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary font-weight-bold">Reassign</button>
	            </div>
	        </form>
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
            <form method="POST" action="{{ route('cases.update_status', ['status' => 3, 'id' => $case->id]) }}">
            	@csrf
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-6">
	                		<div class="row">
								<div class="col-md-12">
									<label>Subject</label>
									<input type="text" class="form-control" value="{{ ucwords($case->subject) ?? '' }}" disabled>
								</div>
							</div>
							<div class="row mt-5">
								<div class="col-md-12">
									<label>Previous case handler</label>
									<input type="text" class="form-control" value="{{ $case->getCaseHandlerName() }}" disabled>
								</div>
							</div>
	                	</div>
	                	<div class="col-md-6">
	                		<div class="row">
								<div class="col-md-12">
									<label>Query</label>
									<textarea class="form-control" id="exampleTextarea" rows="6" placeholder="Query..."></textarea>
								</div>
							</div>
						</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary font-weight-bold">Issue Query</button>
	            </div>
	        </form>
        </div>
    </div>
</div>
<script src="{{ pc_asset(BE_JS.'jquery.js') }}"></script>
<script src="{{ pc_asset(BE_JS.'pages/crud/forms/widgets/select2.js') }}"></script>
@endSection
