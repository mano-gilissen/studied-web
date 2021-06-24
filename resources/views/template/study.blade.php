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

                    <div class="text">Contacteer {{ $study->getHost_Person->first_name }}</div>

                </div>

            @endif

        </div>

        <div id="content">

            <div class="content-columns">

                <div class="column">

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

                </div>

                <div class="column">

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

                </div>

            </div>

            <div class="content-wide">

                <div style="background: pink;width: 100%;height:200px"></div>

            </div>

        </div>

    </div>

@endsection
