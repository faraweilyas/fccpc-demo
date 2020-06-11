@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline mr-5">
				<h5 class="text-dark font-weight-bold my-2 mr-5">Case Handler</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Case Handler</a>
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
							<h3 class="card-title">Handler Information</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<p>
										<strong>Name :</strong>&nbsp;{{ $handler->getFullName() }}
									</p>
									<p>
										<strong>Email :</strong>&nbsp;{{ $handler->email }}
									</p>
									<p>
										<strong>Approved Cases :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-info text-dark label-inline">0</span>
									</p>
									<p>
										<strong>Cases working on : </strong>&nbsp;0
									</p>
									<p>
										<strong>Status :</strong>&nbsp;<span class="label label-lg font-weight-bold label-light-{{ \App\Enhancers\AppHelper::$statusHTML[$handler->status] }} text-white label-inline">{{ \App\Enhancers\AppHelper::$status[$handler->status] }}</span>
									</p>
									<p>
										<strong>Cases on hold : </strong>&nbsp;0
									</p>
									<p>
										<strong>Expedited Cases : </strong>&nbsp;0
									</p>
									<p>
										<strong>Pending Approval: </strong>&nbsp;0
									</p>
									<p>
										<strong>Exceeded timeline: </strong>&nbsp;0
									</p>
									<p>
										<strong>Extensions: </strong>&nbsp;0
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mt-4">
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title">Actions</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-primary mr-2">Issue Query</button>
											</p>
										</div>
										<div class="col-md-6 text-center">
											@if($handler->status == 1)
											<p>
												<a href="{{ route('handlers.update_status', ['id' => $handler->id]) }}">
													<button type="button" class="btn btn-danger mr-2">Deactivate</button>
												</a>
											</p>
											@else
											<p>
												<a href="{{ route('handlers.update_status', ['id' => $handler->id]) }}">
													<button type="button" class="btn btn-primary mr-2">Activate</button>
												</a>
											</p>
											@endif
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#reassignCaseModal">View Cases</button>
											</p>
										</div>
										<div class="col-md-6 text-center">
											<p>
												<button type="button" class="btn btn-warning mr-2">Assign Case</button>
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
@endSection
