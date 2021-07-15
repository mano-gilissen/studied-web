@extends('app')



@section('css')

    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header', ['page_title' => 'Profielpagina'])

    @include('block.menu')

    <div id="wrap">

        <div style="margin: 80px">

            <div class="title">{{ \App\Http\Traits\UserTrait::getFullName($person) }}</div>

            <img style="width:200px;height:200px;margin-top:40px;" src="/storage/avatar/{{ $person->avatar }}"/>

        </div>

    </div>

@endsection
