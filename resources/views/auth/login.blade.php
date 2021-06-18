@extends('app')



@section('css')

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="wrap">



        <img id="logo" src="images/logo.svg">



        <form method="POST" action="{{ route('login') }}" novalidate>



            @csrf



            @include('form.box-input', [
                        'id'                                    => 'email',
                        'placeholder'                           => 'Email adres',
                        'type'                                  => 'email',
                        'value'                                 => old('email'),
                        'required'                              => true])

            @include('form.box-input', [
                        'box_id'                                => 'box-input-password',
                        'id'                                    => 'password',
                        'placeholder'                           => 'Wachtwoord',
                        'type'                                  => 'password',
                        'autocomplete'                          => 'current-password',
                        'required'                              => true])



            <button class="button large" id="button-login" type="submit">

                {{ __('Inloggen') }}

            </button>



        </form>



        <div class="button-free" id="button-forgot-password" onclick="window.location.href='{{ route('password.forgot') }}'">

            {{ __('Wachtwoord vergeten?') }}

        </div>



    </div>



@endsection
