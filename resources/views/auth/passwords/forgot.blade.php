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



        <form method="POST" action="{{ route('password.email') }}">



            @csrf



            <div class="box-input" style="margin-bottom: 48px;">

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

            <strong>{{ $message }}</strong>

            @enderror



            <button type="submit" class="button">

                {{ __('Link sturen') }}

            </button>

        </form>

    </div>

@endsection

