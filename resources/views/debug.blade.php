@extends('app')



@section('css')

    <link href="{{ asset('css/debug.css') }}" rel="stylesheet">

@endsection



@section('content')



    <div class="block-attributes">

        <div class="title">Gegevens</div>

        <div class="list-attributes">

            <div class="attribute">

                <div class="tag">Email</div>

                <div class="value">{{ $user->email }}</div>

            </div>

            <div class="attribute">

                <div class="tag">Rol</div>

                <div class="value">{{ $user->getRole->label }}</div>

            </div>

            <div class="attribute">

                <div class="tag">Naam</div>

                <div class="value">{{ $user->getPerson->prefix }} {{ $user->getPerson->first_name }} {{ $user->getPerson->middle_name }} {{ $user->getPerson->last_name }}</div>

            </div>

        </div>

    </div>



    <div class="block-form" style="margin: 80px 0">

        <div class="title">Formulier</div>

        <form method="POST">

            @csrf

            <div class="field">

                <div class="tag">Onderwerp</div>

                <div class="box-input">

                    <input
                        id                                          = "test"
                        type                                        = "text"
                        name                                        = "test"
                        placeholder                                 = "Vul een onderwerp in">

                </div>

            </div>

            <div class="field">

                <div class="tag">Zoeken</div>

                <div class="box-input">

                    <input
                        id                                          = "search"
                        type                                        = "text"
                        name                                        = "search">

                    <img class="icon" src="images/search.svg">

                </div>

            </div>

            <div class="field">

                <div class="tag">Zoeken</div>

                <div class="box-input">

                    <select
                        id                                          = "start"
                        name                                        = "start">

                        <option value="07:00">07:00</option>
                        <option value="07:15">07:15</option>
                        <option value="07:30">07:30</option>
                        <option value="07:45">07:45</option>
                        <option value="08:00">08:00</option>
                        <option value="08:15">08:15</option>
                        <option value="08:30">08:30</option>
                        <option value="08:45">08:45</option>
                        <option value="09:00">09:00</option>
                        <option value="09:15">09:15</option>
                        <option value="09:30">09:30</option>
                        <option value="09:45">09:45</option>
                        <option value="10:00">10:00</option>
                        <option value="10:15">10:15</option>
                        <option value="10:30">10:30</option>
                        <option value="10:45">10:45</option>
                        <option value="11:00">11:00</option>
                        <option value="11:15">11:15</option>
                        <option value="11:30">11:30</option>
                        <option value="11:45">11:45</option>
                        <option value="12:00">12:00</option>
                        <option value="12:15">12:15</option>
                        <option value="12:30">12:30</option>
                        <option value="12:45">12:45</option>
                        <option value="13:00">13:00</option>
                        <option value="13:15">13:15</option>
                        <option value="13:30">13:30</option>
                        <option value="13:45">13:45</option>
                        <option value="14:00">14:00</option>
                        <option value="14:15">14:15</option>
                        <option value="14:30">14:30</option>
                        <option value="14:45">14:45</option>
                        <option value="15:00">15:00</option>
                        <option value="15:15">15:15</option>
                        <option value="15:30">15:30</option>
                        <option value="15:45">15:45</option>
                        <option value="16:00">16:00</option>
                        <option value="16:15">16:15</option>
                        <option value="16:30">16:30</option>
                        <option value="16:45">16:45</option>
                        <option value="17:00">17:00</option>
                        <option value="17:15">17:15</option>
                        <option value="17:30">17:30</option>
                        <option value="17:45">17:45</option>
                        <option value="18:00">18:00</option>
                        <option value="18:15">18:15</option>
                        <option value="18:30">18:30</option>
                        <option value="18:45">18:45</option>
                        <option value="19:00">19:00</option>
                        <option value="19:15">19:15</option>
                        <option value="19:30">19:30</option>
                        <option value="19:45">19:45</option>
                        <option value="20:00">20:00</option>
                        <option value="20:15">20:15</option>
                        <option value="20:30">20:30</option>
                        <option value="20:45">20:45</option>
                        <option value="21:00">21:00</option>
                        <option value="21:15">21:15</option>
                        <option value="21:30">21:30</option>
                        <option value="21:45">21:45</option>
                        <option value="22:00">22:00</option>
                        <option value="22:15">22:15</option>
                        <option value="22:30">22:30</option>
                        <option value="22:45">22:45</option>
                        <option value="23:00">23:00</option>
                        <option value="23:15">23:15</option>
                        <option value="23:30">23:30</option>
                        <option value="23:45">23:45</option>
                        <option value="00:00">00:00</option>

                    </select>

                    <img class="icon" src="images/search.svg">

                </div>

            </div>

        </form>

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



    <div class="button" onclick="event.preventDefault(); document.getElementById('logout').submit();" style="margin: 40px 0;">

        {{ __('Uitloggen') }}

    </div>



    <form id="logout" method="POST" action="{{ route('logout') }}">

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




