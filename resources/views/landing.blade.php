@extends('app')



@section('css')

    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div class="wrap">

        <a class="dot" href="{{route('debug')}}">

        </a>

    </div>

@endsection
