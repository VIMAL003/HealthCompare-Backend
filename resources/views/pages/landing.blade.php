@extends('layout.app')

@section('title', 'Landing')

@section('description', 'Search Hospital Compare and find the shortest waiting times and highest quality hospitals in England for your treatment now.')

@section('keywords', 'this is the meta keywords')

@section('mobile', 'width=device-width, initial-scale=1, user-scalable=no')

@section('body-class', 'home-page')

@section('content')

    @include('ui.section.landing_hero')

    {{-- @include('ui.section.landing_stats_banner') --}}

    @include('ui.section.header_2_columns')

    {{-- @include('ui.section.landing_compare_online_cards') --}}

    {{-- @include('ui.section.compare_read_our_guide') --}}

    {{-- @include('ui.section.landing-faq') --}}

@endsection
