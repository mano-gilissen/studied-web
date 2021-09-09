@extends('app')



@section('css')

    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        @if (session('status'))

            {{ session('status') }}

        @endif



        <form method="POST" action="{{ route('password.email') }}">



            @csrf



            <input
                id                          ="email"
                type                        ="email"
                class                       ="form-control @error('email') is-invalid @enderror"
                name                        ="email"
                value                       ="{{ old('email') }}"
                autocomplete                ="email"
                placeholder                 ="Vul je email adres in"
                style                       ="margin-bottom: 48px;height:40px"
                required
                autofocus>



            @error('email')

            <strong>{{ $message }}</strong>

            @enderror



            <button type="submit" class="button">

                {{ __('Link sturen') }}

            </button>

        </form>

    </div>

@endsection

