@extends('app')



@section('css')

    <link href="{{ asset('css/feedback.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div class="wrap">

        <div class="content">

            <p style="display: flex;align-items: center">

                <div class="title">{{ $page_title }}</div>

                @if($page_message ?? false)

                    <p class="message">{{ $page_message }}</p>

                @endif

                <img src="/images_app/{{ $icon }}">

            </div>

            <div class="button" onclick="window.location.href='{{ $page_next }}'">{{ $page_action }}</div>

        </div>

    </div>

@endsection
