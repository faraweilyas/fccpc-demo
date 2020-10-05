@extends('layouts.frontend.base')
@section('content')
  <div class="page-content my-5">
    <div class="container row-top">
      <div class="row home-content-header">
        <div class="col-md-7 home-content-header1">
          <h2>Mergers and Aquisition Portal</h2>
          <div class="custom-bar"></div>
        </div>
        <div class="col-md-5 home-content-header2">
          <h2 >Quick Links</h2>
        </div>
      </div>
      <div class="row row-space home-content-container">
        <div class="col-xs-12 col-md-12 col-lg-7 no_display ">
          <p class="text-paragh my-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. At laboriosam hic deserunt velit, sit
            sequi voluptas sapiente culpa. Perferendis, delectus ad dolor est veritatis dicta! Reprehenderit
            mollitia natus facilis excepturi.</p>
        <p class="text-paragh">Lorem ipsum dolor sit amet consectetur adipisicing elit. At laboriosam hic deserunt velit, sit
            sequi voluptas sapiente culpa. Perferendis, delectus ad dolor est veritatis dicta! Reprehenderit
            mollitia natus facilis excepturi.</p>
        <p class="text-paragh">Lorem ipsum dolor sit amet consectetur adipisicing elit. At laboriosam hic deserunt velit, sit
            sequi voluptas sapiente culpa. Perferendis, delectus ad dolor est veritatis dicta! Reprehenderit
            mollitia natus facilis excepturi.</p>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-5">
          <div class="card__box card__box-stack shadow card__box-stack-active" id="control-1" onclick="window.location.href = '{{ route('applicant.show') }}';"
          >
            <img
              class="card__box-stack-img"
              src="{{ FE_IMAGE.'png/folder.png' }}"
              alt="book-open"
            />
            <div class="card__box--content">
              <p>Submit Application</p>
              <span>Submit a Merger Application</span>
            </div>
          </div>
          <div class="card__box card__box-stack shadow" id="control-3" onclick="window.location.href = '{{ route('enquiries.index') }}';">
            <img
              class="card__box-stack-img"
              src="{{ FE_IMAGE.'svg/book-open.svg' }}"
              alt="user-bg"
            />
            <div class="card__box--content">
              <p>Enquiry</p>
              <span>
                Get Relevant information on application cases
              </span>
            </div>
          </div>
          <div class="card__box card__box-stack shadow" id="control-2" onclick="window.location.href = '{{ route('home.fee.calculator') }}';">
            <img
              class="card__box-stack-img"
              src="{{ FE_IMAGE.'png/calculator.png' }}"
              alt="user-bg"
            />
            <div class="card__box--content">
              <p>Fee Calculator</p>
              <span>Fees Guideline for Regular Merger</span>
            </div>
          </div>
          <div class="card__box card__box-stack shadow" id="control-4" onclick="window.location.href = '{{ route('home.faqs') }}';">
            <div>
              <img
                class="card__box-stack-img"
                src="{{ FE_IMAGE.'png/questioncircle.png' }}"
                alt="user-bg"
              />
            </div>
            <div class="card__box--content">
              <p>Frequently Asked Questions</p>
              <span>M&A Related Questions</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
