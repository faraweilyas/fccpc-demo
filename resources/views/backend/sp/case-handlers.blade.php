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
				<h5 class="text-dark font-weight-bold my-2 mr-5">Case Handlers</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Case Handlers</a>
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
							<h3 class="card-label">Case Handlers</h3>
						</div>
						
					</div>
					<div class="card-body">
						<!--begin: Datatable-->
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
								@foreach(\App\User::where('accountType', 'CH')->get() as $handler)
								<tr>
									<td>
										<span class="label label-lg font-weight-bold label-light-dark label-inline">{{ $handler->getFullName() }}</span>
									</td>
									<td>
										<span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">3</span>
									</td>
									<td>
										
										<span class="label label-lg font-weight-bold label-light-primary text-dark label-inline">3</span>
									</td>
									<td>
										<span class="label label-lg font-weight-bold label-light-{{ \App\Enhancers\AppHelper::$statusHTML[$handler->status] }} label-inline">{{ \App\Enhancers\AppHelper::$status[$handler->status] }}</span>
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
	                                                    <a class="nav-link text-hover-danger" href="{{ route('handler.update_status', ['id' => $handler->id]) }}">
	                                                        <i class="nav-icon la la-times-circle"></i>
	                                                        <span class="nav-text text-hover-danger">Deactivate</span>
	                                                    </a>
	                                                    @else
	                                                    <a class="nav-link text-hover-primary" href="{{ route('handler.update_status', ['id' => $handler->id]) }}">
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
@endSection
