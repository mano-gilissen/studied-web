@extends('app')



@section('css')

    <link href="{{ asset('css/form_100823.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset_100823.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        <form method="POST" action="{{ route('password.update') }}">



            @csrf



            <input type="hidden" name="token" value="{{ $token }}">



            <div class="box-input">

                <input
                    id                                  = "email"
                    type                                = "email"
                    class                               = "form-control @error('email') is-invalid @enderror"
                    name                                = "email"
                    value                               = "{{ $email ?? old('email') }}"
                    autocomplete                        = "email"
                    placeholder                         = "Vul je email adres in"
                    required
                    autofocus>

            </div>



            <div class="box-input">

                <input
                    id                                  = "password"
                    type                                = "password"
                    class                               = "form-control @error('password') is-invalid @enderror"
                    name                                = "password"
                    autocomplete                        = "new-password"
                    placeholder                         = "Kies een wachtwoord"
                    required>

            </div>



            <div class="box-input">

                <input
                    id                                  = "password-confirm"
                    type                                = "password"
                    class                               = "form-control"
                    name                                = "password_confirmation"
                    autocomplete                        = "new-password"
                    placeholder                         = "Bevestig het wachtwoord"
                    required>

            </div>



            <div style="height: 64px">

                @if (session('status'))

                    <div style="font-weight: 400">{{ session('status') }}</div>

                @endif

                @error('email')

                    <div style="color: #FF0000">{{ $message }}</div>

                @enderror

                @error('password')

                    <div style="color: #FF0000">{{ $message }}</div>

                @enderror

            </div>



            <button type="submit" class="button">

                {{ __('Wachtwoord herstellen') }}

            </button>

        </form>

    </div>

@endsection

