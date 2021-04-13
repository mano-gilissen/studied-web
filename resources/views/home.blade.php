@extends('app')



@section('css')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div>{{ $user->first_name }}</div>



    <a class="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">

        {{ __('uitloggen') }}

    </a>



    <form id="logout" method="POST" action="{{ route('logout') }}">

        @csrf

    </form>



@endsection




