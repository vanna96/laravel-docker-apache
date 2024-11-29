@extends('frontend.layouts.master')

@section('title', 'Home Page')
@section('meta_description', 'Welcome to the Home Page')

@section('content')
    @include('frontend.home.components.slider')
    @include('frontend.home.components.spotlight')
    @include('frontend.home.components.promotion')
    @include('frontend.home.components.trending')
    @include('frontend.home.components.product')
    @include('frontend.home.components.brand')
@endsection
