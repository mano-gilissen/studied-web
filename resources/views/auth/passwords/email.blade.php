@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        @if (session('status'))

            <div style="font-weight: 400">{{ session('status') }}</div>

        @endif



        <form method="POST" action="{{ route('password.email') }}">



            @csrf



            <div class="box-input" style="margin-bottom: 64px;">

                <input
                    id                          ="email"
                    type                        ="email"
                    class                       ="form-control @error('email') is-invalid @enderror"
                    name                        ="email"
                    value                       ="{{ old('email') }}"
                    autocomplete                ="email"
                    placeholder                 ="Vul je email adres in"
                    required
                    autofocus>

            </div>



            @error('email')

                <div style="font-weight: 400">{{ $message }}</div>

            @enderror



            <button type="submit" class="button" style="margin-left: auto;">

                {{ __('Link sturen') }}

            </button>

        </form>

    </div>

@endsection

