@extends('app')



@section('content')



    @if (session('status'))

            {{ session('status') }}

    @endif



    <form method="POST" action="{{ route('password.email') }}">



        @csrf



        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')

                <strong>{{ $message }}</strong>

        @enderror



        <button type="submit" class="button">

            {{ __('Send Password Reset Link') }}

        </button>



    </form>



@endsection
