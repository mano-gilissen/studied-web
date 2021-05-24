@extends('app')



@section('css')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div>{{ $user->email }}</div>



    <div>{{ $user->getPerson->prefix }} {{ $user->getPerson->first_name }} {{ $user->getPerson->middle_name }} {{ $user->getPerson->last_name }}</div>



    <div>{{ $user->getRole->label }}</div>



    <div style="margin-bottom: 40px;padding: 40px;background: grey">

        @foreach($user->getStudies as $study)

            {{ $study->subject_text }}<br>

        @endforeach

    </div>



    <a class="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">

        {{ __('uitloggen') }}

    </a>



    <form id="logout" method="POST" action="{{ route('logout') }}">

        @csrf

    </form>



@endsection




