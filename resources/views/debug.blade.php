@extends('app')



@section('css')

    <link href="{{ asset('css/debug.css') }}" rel="stylesheet">

@endsection



@section('content')



    <p>email: {{ $user->email }}</p>



    <p>person name: {{ $user->getPerson->prefix }} {{ $user->getPerson->first_name }} {{ $user->getPerson->middle_name }} {{ $user->getPerson->last_name }}</p>



    <p>role: {{ $user->getRole->label }}</p>



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



    <div class="button" onclick="event.preventDefault(); document.getElementById('logout').submit();">

        {{ __('Uitloggen') }}

    </div>



    <form id="logout" method="POST" action="{{ route('logout') }}" style="margin-bottom: 40px;">

        @csrf

    </form>



    <div class="button" onclick="window.location.href='{{ route('password.forgot') }}'" style="margin-bottom: 40px;">

        {{ __('Link button') }}

    </div>



    <div class="button icon" style="margin-bottom: 40px;">

        <img class="icon" src="images/add.svg">

        <div class="text">{{ __('Icon button') }}</div>

    </div>



    <div class="button icon-reverse" style="margin-bottom: 40px;">

        <div class="text">{{ __('Reverse icon button') }}</div>

        <img class="icon" src="images/close.svg">

    </div>



@endsection




