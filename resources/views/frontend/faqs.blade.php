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
		        {{ !is_null($category) ? AppHelper::$faq_categories[$category] : '' }} FAQs
			</div>
	        <h2>{{ !is_null($category) ? AppHelper::$faq_categories[$category] : '' }} Frequently Asked Questions (FAQs)</h2>
	    </div>
	</section>
	<section class="maxwidth-sl mx-auto sub-container">
	    <div class="wrapper">
	        <ul class="none pb-1">
                @foreach($faqs as $faq)
	            <li>
	                <h3 style='margin-bottom: 15px;'>{{ $faq->question }}</h3>
                    <p>{{ $faq->getAnswer(200) }}</p>
                    <p class="read-more-link"><a href="{{ route('home.faqs.faq', $faq) }}">Read More</a></p>
                </li>
                @endforeach
            </ul>
	    </div>
	</section>
</main>
@endSection