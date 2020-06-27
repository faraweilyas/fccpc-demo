@extends('layouts.backend.base')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">{{ $case }}</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">{{ $case }}</a>
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
                            <h3 class="card-label">{{ $case }}</h3>
                            <span class="hide logs_count">{{ \App\Models\Cases::all() }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($type == 'new')
                            @include('layouts.cases.new-cases')
                        @elseif ($type == 'assigned')
                            @include('layouts.cases.assigned-cases')
                        @elseif ($type == 'hold')
                            @include('layouts.cases.cases-on-hold')
                        @elseif($type == 'approved')
                            @include('layouts.cases.approved-cases')
                        @elseif($type == 'archived')
                            @include('layouts.cases.archived-cases')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php $x = 1; @endphp
    @foreach(\App\Models\Cases::all() as $case)
    <div class="modal fade" id="assignCaseModal{{$case->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign case handler to case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('cases.assign', ['id' => $case->id]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Subject</label>
                                <input type="text" class="form-control" value="{{ ucfirst($case->subject) }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <label>Select case handler</label><br>
                                <select class="form-control select2" id="case_handler{{ $x }}" name="case_handler" style="width: 100%;">
                                    @foreach(\App\Models\User::where('status', 1)->where('account_type', 'CH')->get() as $handler)
                                        <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @php $x++; @endphp
    @endforeach
    <script src="{{ pc_asset(BE_JS.'jquery.js') }}"></script>
    <script src="{{ pc_asset(BE_JS.'pages/crud/forms/widgets/select2.js') }}"></script>
@endSection
