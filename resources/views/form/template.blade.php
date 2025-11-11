@extends('app')



@section('css')

    <link href="{{ asset('css/form_210525.css') }}" rel="stylesheet">

    @hasSection('css-form') @yield('css-form') @endif

@endsection



@section('scripts')

    <meta name="theme-color" content="#E6E6E6">

    <script src="{{ asset('js/form_210525.js') }}"></script>

    @hasSection('scripts-form') @yield('scripts-form') @endif

@endsection



@section('content')

    <div id="left">

        <div class="wrap">

            @include('section.header-navigation', ['page_back' => true])

        </div>

    </div>

    <div id="form">

        <div class="block-form">

            <form method="POST" action="{{ route($submit_route) }}" novalidate enctype="multipart/form-data">



                @csrf



                @if($errors->any())

                    <div class="block-note error">{{ __('Vul de juiste gegevens in en probeer het opnieuw.') }}</div>

                    @foreach($errors->all() as $error)

                        {{ $errors }}

                    @endforeach

                    <div class="seperator"></div>

                @endif



                @yield('fields')



                <div id="buttons">

                    @hasSection('actions')

                        @yield('actions')

                    @endif

                    <button class="button" id="button-submit" type="submit">

                        {{ $submit_action }}

                    </button>

                    <div class="button transparent" onclick="window.history.back();">

                        {{ __('Annuleren') }}

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection




