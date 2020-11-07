@extends('layouts.frontend.base')

@section('content')
    <div class="page-content my-5">
        <div class="container-fluid faq-search">
            <div class="row">
                <div class="offset-lg-3  col-md-6">
                    <h2 class="faq-search-title">Get quick answers to your <br /> Frequently Asked Questions!</h2>
                    <div class="form-group">
                        <form id="faqSearchForm" method="GET" action="{{ route('home.faqs.search') }}">
                            <input class="form-control faq-search-input" type="text" name="query" placeholder="Search" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container container-sm">
            <div class="row row-top">
                <div class="col-md-12">
                    <h2 class="publications-header">Frequently Asked Questions</h2>
                </div>
            </div>
            <div class="row publication-container">
                <div class="col-md-1"></div>
                @foreach($faq_categories as $key => $value)
                    <div class="col-md-3">
                        <a href="{{ route('home.faqs.category', ['category' => $key]) }}">
                            <div class="faq-card">
                                <div class="faq-header">{{ $value }}</div>
                                <div class="faq-content">
                                    {{ \AppHelper::value('faq_categories_description', $key) }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
