@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    		<div class="d-flex align-items-center flex-wrap mr-1">
    			<div class="d-flex align-items-baseline mr-5">
    				<h5 class="text-dark font-weight-bold my-2 mr-5">Generate Report</h5>
    				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    					<li class="breadcrumb-item">
    						<a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
    					</li>
    					<li class="breadcrumb-item">
    						<a href="" class="text-muted">Generate Report</a>
    					</li>
    				</ul>
    			</div>
    		</div>
    	</div>
    </div>
@endsection