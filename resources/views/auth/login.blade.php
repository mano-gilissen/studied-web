@extends('app')



@section('css')

    <link href="{{ asset('css/login_110625.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="/images_app/logo.svg">



        <form method="POST" action="{{ route('login') }}" novalidate>



            @csrf



            @include('component.box-input', ['id'                    => 'email',
                                        'type'                  => 'email',
                                        'placeholder'           => __('Email adres'),
                                        'value'                 => old('email'),
                                        'required'              => true])



            @include('component.box-input', ['id_box'                => 'box-input-password',
                                        'id'                    => 'password',
                                        'type'                  => 'password',
                                        'placeholder'           => __('Wachtwoord'),
                                        'autocomplete'          => 'current-password',
                                        'required'              => true])



            <button class="button large" id="button-login" type="submit">

                {{ __('Inloggen') }}

            </button>



        </form>



        <div class="button-free" id="button-forgot-password" onclick="window.location.href='{{ route('password.forgot') }}'">

            {{ __('Wachtwoord vergeten?') }}

        </div>



    </div>



@endsection
