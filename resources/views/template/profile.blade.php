@extends('app')



@section('css')

    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header', ['page_title' => 'Profielpagina'])

    @include('block.menu')

    <img style="width:200px;height:200px" src="/storage/avatar/{{ $person->avatar }}'"/>

@endsection
