@extends('layouts.frontend.base')

@section('content')
<div class="page-content my-5">
    <div class="container container-sm">
        <div class="header-banner">
            <h2 class=" publications-header faq-content-header">
                <a href="{{ url('/faqs') }}" style="color: #999">Frequently Asked Questions</a>
            </h2>

            <div class="form-group">
                <form id="faqSearchForm" method="GET" action="{{ route('home.faqs.search') }}">
                    <input class="form-control faq-search-input" type="text" name="query" placeholder="Search" />
                </form>
            </div>
        </div>
        <div class="row publication-container">
            <div class="col-md-3 publication-height">
                <ul class="faq-questions__ul">
                    <li class="faq-questions__li"><a href="{{ $faq->path() }}" class="faq-questions__a faq-questions__a__active">
                        {{ $faq->question }}</a>
                    </li>
                    @foreach($related_faq as $related_faq)
                        @if($related_faq->id !== $faq->id)
                            <li class="faq-questions__li"><a href="{{ $related_faq->path() }}" class="faq-questions__a">
                                {{ $related_faq->question }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="col-md-9">
                <div class="faq-answer-header">
                    {{ $faq->question }}
                </div>
                <div class="faq-answer-content">
                    @if(Str::contains($faq->question, 'cost to file'))
                        <p>
                            <a href="{{ route('home.fee.calculator') }}" class="fee__CalculatorLink" target="_blank">
                                Click here to calculate your merger fees
                            </a>
                        </p>
                    @endif
                    {!! nl2br($faq->answer) !!}
                </div>
                <div class="text-center">
                    <div class="faq-sub-header">
                        Was this response helpful?
                    </div>
                    <form id="feedback-form" action="{{ route('home.faq.feedback', $faq) }}" method="POST">
                        @csrf
                        <input type="hidden" id="feedback" name="feedback" value="yes" required />
                        <div class=" like-article">
                            <a href="#" class="like-article-section">
                                <img src="{{ FE_IMAGE.'png/thumbs-up.png' }}" alt="thumbs up" />
                                <span class="like-article-yes">
                                    Yes
                                </span>
                            </a>
                            <a href="#" class="unlike-article-section"
                                onclick="document.getElementById('feedback').value = 'no';">
                                <img src="{{ FE_IMAGE.'png/thumbs-down.png' }}" alt="thumbs down" />
                                <span class="like-article-no"> &nbsp; No</span>
                            </a>
                        </div>
                    </form>
                    <div class="sub-title">
                        {{ $faq->countPositiveFeedbacks() }} out of {{ $faq->countFeedbacks() }} found this helpful
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
