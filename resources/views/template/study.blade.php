@extends('app')



@section('css')

    <link href="{{ asset('css/study.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    <div id="wrap">

        <div id="banner" style="background: pink">

            <div class="title">{{ $study->getSubject_Defined ? $study->getSubject_Defined->description : $study->subject_text }}</div>

        </div>

        <div id="actions">

            @if($button_contact_host ?? false)

                <div class="button icon">

                    <img class="icon" src="images/contact.svg">

                    <div class="text">Contacteer {{ $study->getHost->getPerson->first_name }}</div>

                </div>

            @endif

        </div>

        <div id="content">

            <div class="content-columns">

                <div class="column left">

                    <div class="block-attributes">

                        <div class="title">Gegevens</div>

                        <div class="list-attributes">

                            <div class="attribute">

                                <div class="tag">Vak</div>

                                <div class="value">{{ $study->getSubject_Defined ? $study->getSubject_Defined->code : $study->subject_text }}</div>

                            </div>

                            <div class="attribute">

                                <div class="tag">Datum</div>

                                {{ $study->created_at->formatLocalized("%A %e %B") }}

                            </div>

                            <div class="attribute">

                                <div class="tag">Naam</div>

                                <div class="value">789</div>

                            </div>

                            <div class="attribute">

                                <div class="tag">Naam</div>

                                <div class="value">789</div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="column right">

                    <div class="block-users">

                        <div class="title">Student-docent</div>

                        @include('block.user', ['user' => $host])

                    </div>

                    <div class="block-users">

                        <div class="title">Deelnemers</div>

                        <div class="list-users">

                            @foreach($participants as $participant)

                                @include('block.user', ['user' => $participant])

                            @endforeach

                        </div>

                    </div>

                    <div class="block block-attributes">

                        <div class="title">Gegevens</div>

                        <div class="list-attributes">

                            <div class="attribute">

                                <div class="tag">Email</div>

                                <div class="value">123</div>

                            </div>

                            <div class="attribute">

                                <div class="tag">Rol</div>

                                <div class="value">456</div>

                            </div>

                            <div class="attribute">

                                <div class="tag">Naam</div>

                                <div class="value">789</div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="column wide">

                    <div style="background: pink;height:200px"></div>

                </div>

            </div>

        </div>

    </div>

@endsection
