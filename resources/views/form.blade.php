@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div id="left">

        <div class="title page">{{ $page_title }}<span class="dot">.</span></div>

    </div>

    <div id="form">

        <div class="block-form">

            <form method="POST">

                @csrf

                @yield('fields')

                <button class="button" id="button-submit" type="submit">

                    {{ $submit_action }}

                </button>

            </form>

        </div>

    </div>

@endsection




