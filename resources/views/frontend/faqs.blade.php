@extends('layouts.frontend.base')

@section('content')
   <div class="page-content my-5">
      <div class="container  container-sm ">
        <div class="row">
          <h2 class="publications-header">
            Frequently Asked Questions
          </h2>
        </div>

        <div class="row publication-container">
            @foreach($faqs as $faq)
              <div class="col-md-3">
                <a href="{{ $faq->path() }}">
                  <div class="faq-card">
                    <div class="faq-header">{{ $faq->getQuestion() }}</div>
                    <div class="faq-content">
                      {{ $faq->getAnswer(200) }}
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
        </div>
        {{ $faqs->withQueryString()->links() }}
      </div>
    </div>
@endsection
