@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">

@endsection



@section('content')

    <div id="left">

        <div class="wrap">

            @include('block.header-navigation', ['page_back' => true])

        </div>

    </div>

    <div id="form">

        <div class="block-form">

            <form method="POST" action="{{ route($submit_route) }}" novalidate>

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




