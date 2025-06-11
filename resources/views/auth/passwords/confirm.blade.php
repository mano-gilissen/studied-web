@extends('app')



@section('content')



    <form method="POST" action="{{ route('password.confirm') }}">



        @csrf



        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')

            <strong>{{ $message }}</strong>

        @enderror



        <div type="submit" class="button">

            {{ __('Confirm Password') }}

        </div>



        <div class="button" onclick="navigate('{{ route('password.request') }}')">

            {{ __('Forgot Your Password?') }}

        </div>



    </form>



@endsection
