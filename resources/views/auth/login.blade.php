@extends('app')



@section('css')

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

@endsection



@section('content')



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



        <input
            id                                          = "email"
            type                                        = "email"
            name                                        = "email"
            value                                       = "{{ old('email') }}"
            required autocomplete                       = "email" autofocus
            class                                       = "@error('email') is-invalid @enderror" >

        <input
            id                                          = "password"
            type                                        = "password"
            name                                        = "password"
            required autocomplete                       = "current-password"
            class                                       = "@error('password') is-invalid @enderror" >



        <div class="button" type="submit">

            {{ __('Inloggen') }}

        </div>



    </form>



    <div class="button" onclick="window.location.href='{{ route('password.forgot') }}'">

        {{ __('Wachtwoord vergeten') }}

    </div>



@endsection
