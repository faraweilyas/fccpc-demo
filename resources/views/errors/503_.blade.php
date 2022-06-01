@extends('errors.themes.theme')

@section('title', __('Service Unavailable'))

@section('code', '503')

@section('message', __($exception->getMessage() ?: 'Service Unavailable'))