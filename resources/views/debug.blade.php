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



    <p>

        <a class="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">

            {{ __('uitloggen') }}

        </a>

    </p>



    <form id="logout" method="POST" action="{{ route('logout') }}">

        @csrf

    </form>



@endsection




