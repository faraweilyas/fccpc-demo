@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline mr-5">
				<h5 class="text-dark font-weight-bold my-2 mr-5">Case Handlers</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Case Handlers</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="d-flex flex-column-fluid">
			<div class="container">
				<div class="card card-custom">
					<div class="card-header flex-wrap py-5">
						<div class="card-title">
							<h3 class="card-label">Case Handlers</h3>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Approved Cases</th>
									<th>Working on</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach(\App\Models\User::where('account_type', 'CH')->get() as $handler)
								<tr>
									<td>
										{{ $handler->getFullName() }}
									</td>
									<td>
										<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">0</span>
									</td>
									<td>

										<span class="label label-lg font-weight-bold label-light-primary text-dark label-inline">0</span>
									</td>
									<td>
										<span class="label label-lg font-weight-bold label-light-{{ $handler->getStatusHtml() }} label-inline">{{ $handler->getStatus() }}</span>
									</td>
									<td nowrap="nowrap">
	                                    <div class="dropdown dropdown-inline">
	                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                            <span class="text-center"><i class="la la-ellipsis-h"></i></span>
	                                        </a>
	                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
	                                            <ul class="nav nav-hoverable flex-column">
	                                                <li class="nav-item">
	                                                    <a class="nav-link text-hover-primary" href="{{ route('handlers.view', ['id' => $handler->id]) }}">
	                                                        <i class="nav-icon la la-info-circle"></i>
	                                                        <span class="nav-text text-hover-primary">View</span>
	                                                    </a>
	                                                </li>
	                                                <li class="nav-item">
	                                                	@if($handler->status == 1)
	                                                    <a class="nav-link text-hover-danger" href="{{ route('handlers.update_status', ['id' => $handler->id]) }}">
	                                                        <i class="nav-icon la la-times-circle"></i>
	                                                        <span class="nav-text text-hover-danger">Deactivate</span>
	                                                    </a>
	                                                    @else
	                                                    <a class="nav-link text-hover-primary" href="{{ route('handlers.update_status', ['id' => $handler->id]) }}">
	                                                        <i class="nav-icon la la-times-circle"></i>
	                                                        <span class="nav-text text-hover-primary">Activate</span>
	                                                    </a>
	                                                    @endif
	                                                </li>
	                                            </ul>
	                                        </div>
	                                    </div>
	                                </td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endSection
