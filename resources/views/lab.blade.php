@extends('app')



@section('css')

    <link href="{{ asset('css/lab.css') }}" rel="stylesheet">

@endsection



@section('content')



    @include('block.header')



    <div id="content">



        <div class="block-attributes">

            <div class="title">Gegevens</div>

            <div class="list-attributes">

                <div class="attribute">

                    <div class="name">Email</div>

                    <div class="value">{{ $user->email }}</div>

                </div>

                <div class="attribute">

                    <div class="name">Rol</div>

                    <div class="value">{{ $user->getRole->label }}</div>

                </div>

                <div class="attribute">

                    <div class="name">Naam</div>

                    <div class="value">{{ $user->getPerson->prefix }} {{ $user->getPerson->first_name }} {{ $user->getPerson->middle_name }} {{ $user->getPerson->last_name }}</div>

                </div>

            </div>

        </div>



        @if($user->hasStudies())

            <p>
                lessen:<br><br>

                @foreach($user->getStudies as $study)

                    {{ $study->subject_text }}<br>

                @endforeach

            </p>

        @endif



        @if($user->isCustomer())

            <p>
                leerlingen:<br><br>

                @foreach($user->getCustomer->getStudents as $student)

                    {{ $student->getUser->getPerson->first_name }} {{ $student->getUser->getPerson->last_name }}<br>

                @endforeach

            </p>

        @endif



        <div class="button" onclick="window.location.href='{{ route('form_test.view') }}'" style="margin: 40px 0;">

            {{ __('Formulier pagina') }}

        </div>



        <div class="button" onclick="window.location.href='{{ route('study_test.view') }}'" style="margin-bottom: 40px;">

            {{ __('Les pagina') }}

        </div>



        <div class="button icon" style="margin-bottom: 40px;">

            <img class="icon" src="/images/add.svg">

            <div class="text">{{ __('Icon button') }}</div>

        </div>



        <div class="button icon-reverse" style="margin-bottom: 40px;">

            <div class="text">{{ __('Reverse icon button') }}</div>

            <img class="icon" src="/images/close.svg">

        </div>



        <div class="button" onclick="event.preventDefault(); document.getElementById('logout').submit();" style="margin-bottom: 40px;">

            {{ __('Uitloggen') }}

        </div>



        <form id="logout" method="POST" action="{{ route('logout') }}">

            @csrf

        </form>



    </div>



@endsection




