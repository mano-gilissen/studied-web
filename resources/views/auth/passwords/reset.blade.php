@extends('app')



@section('content')



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



        <button type="submit" class="btn btn-primary">

            {{ __('Reset Password') }}

        </button>



    </form>



@endsection
