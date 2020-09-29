@extends('layouts.frontend.base')
@section('content')
  <div class="page-content my-5">
    <div class="container">
      <div class="row home-content-header">
        <div class="col-md-7 home-content-header1">
          <h2>Mergers and Aquisition Portal</h2>
          <div class="custom-bar"></div>
        </div>
        <div class="col-md-5 home-content-header2">
          <h2>Take an action</h2>
        </div>
      </div>
      <div class="row row-space home-content-container">
        <div class="col-xs-12 col-md-12 col-lg-7 no_display">
          <img
            class="img-fluid"
            src="{{ FE_IMAGE.'png/home-img.png' }}"
            alt="fccpc"
          />
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
          <div class="card__box card__box-stack shadow" id="control-3">
            <img
              class="card__box-stack-img"
              src="{{ FE_IMAGE.'svg/book-open.svg' }}"
              alt="user-bg"
            />
            <div class="card__box--content">
              <p>Application Case Information</p>
              <span>
                Get Relevant information on application cases
              </span>
            </div>
          </div>
          <div class="card__box card__box-stack shadow" id="control-4">
            <div>
              <img
                class="card__box-stack-img"
                src="{{ FE_IMAGE.'png/question-circle.png' }}"
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
