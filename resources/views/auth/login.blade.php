@extends('app')



@section('css')

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="images/logo.svg">



        <form method="POST" action="{{ route('login') }}">



            @csrf



            <div style="height: 40px">

                @error('email')

                    <div class="form-error" role="alert">{{ $message }}</div>

                @enderror

                @error('password')

                    <div class="form-error" role="alert">{{ $message }}</div>

                @enderror

            </div>





            <div class="box-input">

                <input
                    id                                          = "email"
                    type                                        = "email"
                    name                                        = "email"
                    placeholder                                 = "Email adres"
                    value                                       = "{{ old('email') }}"
                    required autocomplete                       = "email" autofocus
                    class                                       = "@error('email') is-invalid @enderror" >

            </div>

            <div class="box-input" id="box-input-password">

                <input
                    id                                          = "password"
                    type                                        = "password"
                    name                                        = "password"
                    placeholder                                 = "Wachtwoord"
                    required autocomplete                       = "current-password"
                    class                                       = "@error('password') is-invalid @enderror" >

            </div>



            <button class="button large" id="button-login" type="submit">

                {{ __('Inloggen') }}

            </button>



        </form>



        <div class="button-free" id="button-forgot-password" onclick="window.location.href='{{ route('password.forgot') }}'">

            {{ __('Wachtwoord vergeten?') }}

        </div>



    </div>



@endsection
