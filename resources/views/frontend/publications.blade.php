@extends('layouts.frontend.base')

@section('content')
	<div class="page-content">
      <div class="container publication-container ">
        <div class="row py-5">
          <h2 class=" publications-header">Publications</h2>
        </div>
        <div class="row">
          <div class="col-md-4 publication-img read-more-main-img">
            <img src="{{ FE_IMAGE.'png/publictest1.png' }}" alt="img" />
            <div class="publication-header">
              <h3>TNP Takes Its Services To Abuja, Sets Up New</h3>
            </div>
            <div class="publication-content">
              <p>
                TNP, Nigeria’s “Glocal” and commercially oriented
                law firm and a collaborating firm of Andersen Global
                has made yet another bold move by taking its
                business into the city of Abuja, Nigeria’s Federal
                Capital. This new development is in line with the
                firm’s goal to boost service delivery to meet the
                business needs of our clients.
              </p>
            </div>
            <div class="read-more-link">
              <a href="{{ route('home.publications.view', ['publication' => 2]) }}">Read More</a>
            </div>
          </div>
          <div class="col-md-4 publication-img">
            <img src="{{ FE_IMAGE.'png/publictest1.png' }}" alt="img" />
            <div class="publication-header">
              <h3>TNP Takes Its Services To Abuja, Sets Up New</h3>
            </div>
            <div class="publication-content">
              <p>
                TNP, Nigeria’s “Glocal” and commercially oriented
                law firm and a collaborating firm of Andersen Global
                has made yet another bold move by taking its
                business into the city of Abuja, Nigeria’s Federal
                Capital. This new development is in line with the
                firm’s goal to boost service delivery to meet the
                business needs of our clients.
              </p>
            </div>
            <div class="read-more-link">
              <a href="{{ route('home.publications.view', ['publication' => 2]) }}">Read More</a>
            </div>
          </div>
          <div class="col-md-4 publication-img">
            <img src="{{ FE_IMAGE.'png/publictest1.png' }}" alt="img" />
            <div class="publication-header">
              <h3>TNP Takes Its Services To Abuja, Sets Up New</h3>
            </div>
            <div class="publication-content">
              <p>
                TNP, Nigeria’s “Glocal” and commercially oriented
                law firm and a collaborating firm of Andersen Global
                has made yet another bold move by taking its
                business into the city of Abuja, Nigeria’s Federal
                Capital. This new development is in line with the
                firm’s goal to boost service delivery to meet the
                business needs of our clients.
              </p>
            </div>
            <div class="read-more-link">
              <a href="{{ route('home.publications.view', ['publication' => 2]) }}">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endSection