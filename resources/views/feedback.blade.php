@extends('app')



@section('css')

    <link href="{{ asset('css/feedback_210525.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div class="wrap">

        <div class="content">

            <div class="title-wrap">

                <div class="title">{{ $page_title }}</div>

                <img src="/images_app/{{ $icon }}">

            </div>

            @if($page_message ?? false)

                <p class="message">{!! $page_message !!}</p>

            @endif

            <div class="button" onclick="window.location.href='{{ $page_next }}'">{{ $page_action }}</div>

        </div>

    </div>

@endsection
