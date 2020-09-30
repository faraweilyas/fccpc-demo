@extends('layouts.frontend.base')

@section('content')
   <div class="page-content my-5">  

    <style>
      .faq-search{
        /* width: 100%; */
        height: 50vh;
        background: #227a4e;
        padding: 10rem 3rem;
      }
      .faq-search-title{
        color: #fff;
        font-size: 3rem;
        text-align: center;
      }

      .faq-search-input{
        padding: 0 3rem !important;
        
      }
    </style>

   <div class="container-fluid faq-search">
    <div class="row">
      <div class="offset-lg-3  col-md-6">
        <h2 class="faq-search-title">Get quick answers to your <br> Frequently Asked Questions!</h2>
          <div class="form-group">
          <input class="form-control faq-search-input" type="text" name="Search" placeholder="Search">
          </div>
      </div>
     
    </div>
  </div>
    <div class="container  container-sm ">


        <div class="row row-top" >
          <h2 class="publications-header">
            Frequently Asked Questions
          </h2>
        </div>

        <div class="row publication-container">
            @foreach($faq_categories as $key => $value)
              @if(\App\Models\Faq::where('category', $key)->count() > 0)
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
              @endif
            @endforeach
        </div>
      </div>
    </div>
@endsection
