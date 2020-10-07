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



<div class="container py-5">

    <div class="row ">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="d-flex py-4">

                <img src="{{ pc_asset(BE_IMAGE.'svg/book-open.svg') }}" alt="book-open" />

                <div class="gr-header-content">
                    <p>New Report</p>
                    <span>Create your new report</span>
                </div>
            </div>
            <form method="POST" action="{{ route('dashboard.report') }}">
                @csrf
                <div class="card__box card__box__large  rmv-height add-mgbottom " id="applications">
                    <div class="card__box__large-content">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input class="form-control" type="date" name="start_date" />
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input class="form-control" type="date" name="end_date" />
                        </div>

                        @if (in_array(\Auth::user()->account_type, ['CH']))
                            <input type="hidden" name="handler_id[]" value="{{ \Auth::user()->id }}">
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Case Handler</label>
                                    <select class="form-control form-control-table select2" id="get_handler"
                                        name="handler_id[]" style="width: 100%;" multiple="multiple">
                                        @foreach($handlers as $handler)
                                        <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div id="custom-filter" class="row mt-4 hide">
                            <div class="col-md-12">
                                <label>Transaction Type</label>
                                <select class="form-control form-control-table" name="type">
                                    @foreach(\AppHelper::get('case_types') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Transaction Category</label>
                                <select class="form-control form-control-table" name="category">
                                    @foreach(\AppHelper::get('case_categories') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-primary">
                                    <input id="custom-filter-check" type="checkbox" name="custom-filter-check">
                                    <span></span></label>Custom Filter
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block">
                                    Submit Request
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection

@section('custom.javascript')


<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>

<script>
    $(document).ready(function () {
        $('#get_handler').select2();
        $('#custom-filter-check').on('click', function(){
            if($(this).prop("checked") == true){
                $("#custom-filter").toggle();
            }
            else if($(this).prop("checked") == false){
                $("#custom-filter").toggle();
            }
        });
    })

</script>
@endsection
