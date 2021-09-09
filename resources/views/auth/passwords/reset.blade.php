@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        @if (session('status'))

            <div style="font-weight: 400">{{ session('status') }}</div>

        @endif



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

            @error('email')

                <strong>{{ $message }}</strong>

            @enderror



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

            @error('password')

                <strong>{{ $message }}</strong>

            @enderror



            <div class="box-input" style="margin-bottom: 64px;">

                <input
                    id                                  = "password-confirm"
                    type                                = "password"
                    class                               = "form-control"
                    name                                = "password_confirmation"
                    autocomplete                        = "new-password"
                    placeholder                         = "Bevestig het wachtwoord"
                    required>

            </div>



            <button type="submit" class="button">

                {{ __('Wachtwoord herstellen') }}

            </button>

        </form>

    </div>

@endsection

