@extends('app')



@section('css')

    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        <form method="POST" action="{{ route('password.email') }}">



            @csrf



            <div class="box-input">

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



            <div style="height: 64px">

                @if (session('status'))

                    <div style="font-weight: 400">{{ session('status') }}</div>

                @endif



                @error('email')

                    <div style="color: #FF0000">{{ $message }}</div>

                @enderror

            </div>



            <button type="submit" class="button" style="margin-left: auto;">

                {{ __('Link sturen') }}

            </button>

        </form>

    </div>

@endsection

