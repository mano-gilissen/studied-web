@extends('app')



@section('content')



    <form method="POST" action="{{ route('passwords.confirm') }}">



        @csrf



        <input id="password" type="password" class="form-control @error('passwords') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('passwords')

            <strong>{{ $message }}</strong>

        @enderror



        <button type="submit" class="button">

            {{ __('Confirm Password') }}

        </button>



        <a class="button" href="{{ route('passwords.request') }}">

            {{ __('Forgot Your Password?') }}

        </a>



    </form>



@endsection
