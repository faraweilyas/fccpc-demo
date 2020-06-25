@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline mr-5">
				<h5 class="text-dark font-weight-bold my-2 mr-5">Users</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="" class="text-muted">Users</a>
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
						<h3 class="card-label">Users</h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Account Type</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach(\App\User::where('id', '!=', \Auth::user()->id)->get() as $item)
							<tr>
								<td>{{ $item->getFullName() }}</td>
								<td>{{ $item->email }}</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-{{ $item->getAccountTypeHtml() }} label-inline">
                                        {{ $item->getAccountType() }}
                                    </span>
								</td>
								<td>
									<span class="label label-lg font-weight-bold label-light-{{ $item->getStatusHtml() }} label-inline">
                                        {{ $item->getStatus() }}
                                    </span>
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
				</div>
			</div>
		</div>
	</div>
</div>
@endsection