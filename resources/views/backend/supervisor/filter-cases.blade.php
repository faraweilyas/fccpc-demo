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
				<h5 class="text-dark font-weight-bold my-2 mr-5">Filter Cases</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('admin.index') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Filter Cases</a>
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
		<!--begin::Container-->
		<div class="container">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">View Cases By Case Handler
					</div>
				</div>
				<div class="card-body">
					<!--begin::Search Form-->
					<div class="mb-7">
						<div class="row align-items-center">
							<div class="col-lg-9 col-xl-8">
								<div class="row align-items-center">
									<div class="col-md-4 my-2 my-md-0">
										<div class="input-icon">
											<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
											<span>
												<i class="flaticon2-search-1 text-muted"></i>
											</span>
										</div>
									</div>
									<div class="col-md-4 my-2 my-md-0">
										<div class="d-flex align-items-center">
											<label class="mr-3 mb-0 d-none d-md-block">Handler:</label>
											<select class="form-control" id="kt_datatable_search_handler">
												<option value="">All</option>
												<option value="Yemisi">Yemisi</option>
												<option value="Morayo">Morayo</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end::Search Form-->
					<!--begin: Datatable-->
					<table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
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
									FCCPC/BC/M&A/00/20/VOLNo
								</td>
								<td>
									Application
								</td>
								<td>M&A Case Management System</td>
								<td>Techbarn, FCCPC</td>
								<td>T&A Legal</td>
								<td>FFM</td>
								<td class="text-right">Morayo</td>
							</tr>
							<tr>
								<td>
									FCCPC/BC/M&A/00/20/VOLNo
								</td>
								<td>
									Application
								</td>
								<td>M&A Case Management System</td>
								<td>Techbarn, FCCPC</td>
								<td>T&A Legal</td>
								<td>FFM</td>
								<td class="text-right">Yemisi</td>
							</tr>
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