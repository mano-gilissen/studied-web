@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        @if (session('status'))

            {{ session('status') }}

        @endif


        <form method="POST" action="{{ route('password.update') }}">



            @csrf



            <input type="hidden" name="token" value="{{ $token }}">



            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')

                <strong>{{ $message }}</strong>

            @enderror



            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')

                <strong>{{ $message }}</strong>

            @enderror



            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">



            <button type="submit" class="button">

                {{ __('Wachtwoord herstellen') }}

            </button>



        </form>

    </div>

@endsection

