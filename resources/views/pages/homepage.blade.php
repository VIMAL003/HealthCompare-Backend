@extends('layout.app')

@section('title', 'Homepage')

@section('description', 'Search Hospital Compare and find the shortest waiting times and highest quality hospitals in England for your treatment now.')

@section('keywords', 'this is the meta keywords')

@section('mobile', 'width=device-width, initial-scale=1, user-scalable=no')

@section('body-class', 'home-page')

@section('content')

    @include('ui.section.home_hero')


    @include('ui.section.compare_nav_blocks')

    @include('ui.section.header_2_columns', ['wrapperClass'=>"pb-lg-5"])

    @include('ui.section.cta_banner_overflowing_image')

    @include('ui.section.compare_online_cards')

    @include('ui.section.faq')

@endsection
