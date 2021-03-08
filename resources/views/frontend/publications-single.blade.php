@extends('layouts.frontend.base')

@section('content')
<div class="page-content my-5">
    <div class="container row-top">
        <div class="row">
            <div class="col-md-10 mx-auto case__info">
                <a href="#">
                    <h1>{{ ucfirst($publication->case->subject) }}</h1>
                </a>
                <span>Case type: {{ $publication->case->getType() }}</span>
                <span>Case category: {{ $publication->case->getCategoryText() }}</span>
                @if ($publication->case->isApprovalApproved())
                    <span>Case state: Closed </span>
                @else
                    <span>Case state: Open </span>
                @endif
                <span>Opened: {{ $publication->case->getSubmittedAt() }} </span>
                @if ($publication->case->isApprovalApproved())
                    <span>Closed: {{ $publication->case->caseClosedAt() }}</span>
                @endif
                <span>Published: {{ $publication->getPublishedAt() }} </span>
                <hr />
                <p>{!! html_entity_decode($publication->text) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
