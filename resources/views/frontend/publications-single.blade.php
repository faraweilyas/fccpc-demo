@extends('layouts.frontend.base')

@section('content')
<div class="page-content my-5">
    <div class="container row-top">
        <div class="row">
            <div class="col-md-10 mx-auto case__info">
                <a href="#">
                    <h1>{{ ucfirst($publication->case->subject) }}</h1>
                </a>
                <span>Case type: Mergers</span>
                <span>Case category: Small</span>
                <span>Case state: Open </span>
                <span>Opened: 5 March 2021 </span>
                <span>Closed: 5 March 2021 </span>
                <hr />
                {!! html_entity_decode($publication->text) !!}
            </div>
        </div>
    </div>
</div>
@endsection
