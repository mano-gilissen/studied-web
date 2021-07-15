@extends('app')



@section('css')

    <link href="{{ asset('css/list.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    @include('block.menu')

    <div id="wrap">

        <div id="content">

            @yield('counters')

        </div>

    </div>

@endsection




