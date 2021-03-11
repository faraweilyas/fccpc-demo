@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Publish Case</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        @if(in_array(\Auth::user()->account_type, ['SP']))
                            <li class="breadcrumb-item">
                                <a href="{{ route('cases.unassigned') }}" class="text-muted">New Cases</a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">
                            <a href="{{ route('cases.assigned') }}" class="text-muted">Assigned Cases</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('cases.analyze', ['case' => $case->id]) }}"
                                class="text-muted"
                            >
                                Analyze Case
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Publish Case</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Publish Case</h3>
                    </div>
                    <form method="POST" action="{{ route("cases.publish", ['case' => $case]) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Form 1A Content</label> <span class="text-danger">*</span>
                                        <textarea class="summernote kt_maxlength_5 max_text" id="summernote" name="content" value="{{ $case->publication->text ?? '' }}">{!! html_entity_decode($case->publication->text ?? $case->form_1A_Text) !!}</textarea>
                                        @error('content')
                                        <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 text-right">
                                    <button type="submit" name="save" class="btn btn-light-primary mr-2">Save</button>
                                    <button type="submit" name="publish" class="btn btn-primary mr-2">Save &amp; Publish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom.css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section("custom.javascript")
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
@endsection
