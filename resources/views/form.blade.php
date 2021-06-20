@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div id="left">

        <div class="wrap">

            <img class="back" src="images/back.svg"/>

            <div class="title page">{{ $page_title }}<span class="dot">.</span></div>

        </div>

    </div>

    <div id="form">

        <div class="block-form">

            <form method="POST" novalidate>

                @csrf

                @yield('fields')

                <div id="buttons">

                    <button class="button" id="button-submit" type="submit">

                        {{ $submit_action }}

                    </button>

                    <div class="button transparent">

                        {{ __('Annuleren') }}

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection




