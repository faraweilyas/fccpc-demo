@extends('layouts.frontend.base')

@section('content')
<div class="page-content my-5">
    <div class="container row-top">
        <div class="row">
            <div class="col-md-8 mx-auto case__info">
                <a href="#">
                    <h1>{{ ucfirst($publication->case->subject) }}</h1>
                </a>
                <span>Case type: {{ $publication->case->getCategoryText() }}</span>
                <span>Published: {{ $publication->getPublishedAt() }} </span>
                <hr />
                <p>{!! html_entity_decode($publication->text) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
