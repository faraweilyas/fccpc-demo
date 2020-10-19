@extends('layouts.backend.old.guest')


@section('content')

<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        {{-- <a href="{{ $guest->applicationPath() }}" class="text-muted">Home</a> --}}
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Checklist Documents</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="container ">
    <div class="row row-top">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="card__box card__box__large ">

                <div class="card__box__large-content">
                    <h3 class="checklist-header">
                        Document Checklist
                    </h3>
                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                    <li class="checklist-list">
                        {{ ucfirst($checklistGroup->name) }}
                    </li>
                        @foreach($checklistGroup->checklists as $checklist)
                        <li class="checklist-list-sub">
                            {{ ucfirst($checklist->name) }}
                        </li>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>



@endsection
