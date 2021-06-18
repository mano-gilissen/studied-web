@extends('app')



@section('css')

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="images/logo.svg">



        <form method="POST" action="{{ route('login') }}" novalidate>



            @csrf



            <div class="box-input @error('email') invalid @enderror ">

                <input
                    id                                          = "email"
                    type                                        = "email"
                    name                                        = "email"
                    placeholder                                 = "Email adres"
                    value                                       = "{{ old('email') }}"
                    autocomplete                                = "off"
                    required>

            </div>

            @error('email')

                <div class="input-invalid">{{ $message }}</div>

            @enderror



            <div class="box-input @error('password') invalid @enderror " id="box-input-password">

                <input
                    id                                          = "password"
                    type                                        = "password"
                    name                                        = "wachtwoord"
                    placeholder                                 = "Wachtwoord"
                    autocomplete                                = "current-password"
                    required>

            </div>

            @error('password')

                <div class="input-invalid">{{ $message }}</div>

            @enderror



            <button class="button large" id="button-login" type="submit">

                {{ __('Inloggen') }}

            </button>



        </form>



        <div class="button-free" id="button-forgot-password" onclick="window.location.href='{{ route('password.forgot') }}'">

            {{ __('Wachtwoord vergeten?') }}

        </div>



    </div>



@endsection
