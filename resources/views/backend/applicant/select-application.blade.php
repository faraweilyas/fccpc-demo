@extends('layouts.backend.old.guest')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent mt-xs-20 mt-sm-18 mt-md-20 mt-lg-0 " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ $guest->applicationPath() }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Select transaction category</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-primary alert-warning fade show lightish-yellow lightish-yellow-border" role="alert">
                            <div class="alert-text text-dark">
                                <i class="la la-info text-dark"></i>
                                Note: Please complete an application form before you begin this process.
                                <a href="{{ route('home.resources') }}" target="_blank">
                                    Click here
                                </a> to visit the resource page and download the required form.
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-4 pb-10">
                        <a href="{{ $guest->createApplicationPath('reg') }}">
                            @php
                                $regStyle = $guest->case->selectedCategoryStyle('REG');
                                $ffmStyle = $guest->case->selectedCategoryStyle('FFM');
                                $ffxStyle = $guest->case->selectedCategoryStyle('FFX');
                            @endphp
                            <div class="card card-custom gutter-b card__with__bg {{ $regStyle->bg }}" style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x {{ $regStyle->svg }}">
                                        <x-icons.file-tag></x-icons.file-tag>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right {{ $regStyle->svg }}">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 {{ $regStyle->text }}">Merger</div>
                                    <span class="font-weight-bold font-size-lg mt-1 {{ $regStyle->textsm }}">
                                        <br />
                                        <small class="text-black">
                                            Occurs when one or more undertakings directly or indirectly acquires or establish direct or indirect control over the whole or part of the business of another undertaking. 
                                        </small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 pb-10">
                        <a href="{{ $guest->createApplicationPath('ffm') }}">
                            <div class="card card-custom gutter-b card__with__bg {{ $ffmStyle->bg }}" style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x {{ $ffmStyle->svg }}">
                                        <x-icons.arrow-meet></x-icons.arrow-meet>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right {{ $ffmStyle->svg }}">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 {{ $ffmStyle->text }}">Simplified Procedure</div>
                                    <span class="font-weight-bold font-size-lg mt-1 {{ $ffmStyle->textsm }}">
                                        <br />
                                        <small class="text-black">
                                            If upon self-assessment, the parties are of the view that a proposed merger is less than likely to prevent or lessen competition Form 2 may be applicable.
                                        </small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 pb-10">
                        <a href="{{ $guest->createApplicationPath('ffx') }}">
                            <div class="card card-custom gutter-b  card__with__bg {{ $ffxStyle->bg }}"
                                style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x {{ $ffxStyle->svg }}">
                                        <x-icons.arrow-crop></x-icons.arrow-crop>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right {{ $ffxStyle->svg }}">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 {{ $ffxStyle->text }}">Negative Clearance</div>
                                    <span class="font-weight-bold font-size-lg mt-1 {{ $ffxStyle->textsm }}">
                                        <br />
                                        <small class="text-black">
                                            Where parties to a transaction are uncertain whether or not a proposed transaction constitutes a relevant merger and is notifiable, it may apply to the Commission using Form 4.
                                        </small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
