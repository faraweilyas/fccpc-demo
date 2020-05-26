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
				<h5 class="text-dark font-weight-bold my-2 mr-5">Users</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Users</a>
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
						<h3 class="card-label">Users</h3>
					</div>
				</div>
				<div class="card-body">
					<!--begin: Datatable-->
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
								<th>Account Type</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach(\App\User::all() as $item)
							<tr>
								<td><span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">{{ $item->getFullName() }}</span></td>
								<td><span class="label label-lg font-weight-bold label-light-info text-dark label-inline">{{ $item->email }}</span></td>
								<td>
									<span class="label label-lg font-weight-bold label-light-{{ \App\Enhancers\AppHelper::$statusHTML[$item->status] }} label-inline">{{ \App\Enhancers\AppHelper::$status[$item->status] }}</span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-{{ \App\Enhancers\AppHelper::$account_typesHTML[$item->accountType] }} label-inline">{{ \App\Enhancers\AppHelper::$account_types[$item->accountType] }}</span>
								</td>
								<td>
									@if($item->status == 1)
										<a href="{{ route('dashboard.update_users_status', ['id' => $item->id]) }}" class="btn btn-sm btn-icon text-hover-danger" title="Deactivate User">
											<i class="la la-times-circle"></i>&nbsp;&nbsp;Deactivate
										</a>
									@else
										<a href="{{ route('dashboard.update_users_status', ['id' => $item->id]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
											<i class="la la-check"></i>&nbsp;&nbsp;Activate
										</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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
@endsection