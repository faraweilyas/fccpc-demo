@extends('layouts.frontend.base')
@section('content')
<main>
        <section class=" maxwidth-sl mx-auto top-heading">
            <div class="wrapper">
                <div class="py-2 breadcrumbs ff-sans-serif pb-h d-ifx al-i-c">
                    <a href="http://fccpc.gov.ng/" class="opacity-7-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon" style="transform:translateY(-2px)">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-cheveron-right">
                      <defs>
                        <style>
                          svg {
                            width: 15px;
                          }

                        </style>
                      </defs>
                      <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                    Faq
                </div>
                <h2>Frequently Asked Question (FAQ)</h2>
            </div>
        </section>
        <section class="maxwidth-sl mx-auto sub-container">
            <div class="wrapper">
                <ul class="none pb-1">
                    <li>
                        <h3>{{ $faq->question }}</h3>
                        <p></p>
                        <p>
                            {{ $faq->answer }}
                        </p>
                        <p></p>
                    </li>
                    <div class="sub-article-container shaded mb-9 text-center">
                        <div class="as">
                            <div class="title">Was this article helpful?</div>
                            <div class="clear-fix"></div>
                            <div class="button-group">
                                <a href="{{ route('home.faq.feedback', ['id' => 1, 'question' => $faq->id]) }}" class="as-button" data-value="5" type="button">Yes</a>
                                <a href="{{ route('home.faq.feedback', ['id' => 0, 'question' => $faq->id]) }}" class="as-button" data-value="1" type="button">No</a>
                            </div>
                            <div class="sub-title">{{ \App\Models\Feedback::where('question_id', $id)->where('feedback', 1)->count() }} out of {{ \App\Models\Feedback::where('question_id', $id)->count() }} found this helpful</div>
                        </div>
                    </div>
                </ul>
            </div>
        </section>
    </main>
@endSection
