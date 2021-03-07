@extends('layouts.frontend.base')

@section('content')
<div class="page-content my-5">
    <div class="container row-top">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="form-group">
                    <form id="faqSearchForm" method="GET" action="{{ route('home.faqs.search') }}">
                        <input class="form-control faq-search-input" type="text" name="query" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto case__info">
                <h3>
                    <b>
                        {{ (new App\Models\Publication)->getTotalPublications(TRUE) }}
                    </b>
                </h3>
                <hr />
                @foreach($publications as $publication)
                    <hr />
                        <a href="{{ route('home.publications.view', ['slug' => $publication->slug]) }}">
                            <h3>{{ ucfirst($publication->case->subject) }}</h3>
                        </a>
                        <span>Case type: Mergers</span>
                        <span>Case category: Small</span>
                        <span>Case state: Open </span>
                        <span>Opened: 5 March 2021 </span>
                        <span>Closed: 5 March 2021 </span>
                    <hr />
                @endforeach
            </div>
        </div>
       <div class="row">
           <div class="col-md-12">
                {{ $publications->links() }}
            </div>
       </div>
    </div>
</div>
@endsection
