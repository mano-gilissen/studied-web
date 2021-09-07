@extends('app')



@section('css')

    <link href="{{ asset('css/feedback.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div class="wrap">

        <div class="content">

            <div class="title">{{ $page_title }}</div>

            <img src="/images_app/{{ $icon }}">

            <a class="button" href="{{ $page_next }}">{{ $page_action }}</a>

        </div>

    </div>

@endsection
