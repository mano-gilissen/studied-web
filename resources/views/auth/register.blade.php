@extends('app')



@section('content')



    <form method="POST" action="{{ route('register') }}">



        @csrf



        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')

            <strong>{{ $message }}</strong>

        @enderror



        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')

            <strong>{{ $message }}</strong>

        @enderror



        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')

            <strong>{{ $message }}</strong>

        @enderror



        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">



        <div type="submit" class="button">

            {{ __('Register') }}

        </div>



    </form>



@endsection
