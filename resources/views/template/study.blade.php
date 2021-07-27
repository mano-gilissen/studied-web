@extends('app')



@section('css')

    <link href="{{ asset('css/study.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    <div id="wrap">

        <div id="column">

            <div id="banner" style="background-image:url({{url('images/study_banner_example.png')}})">

                <div>

                    <div class="title">{{ $study->getSubject_Defined ? $study->getSubject_Defined->description_subject : $study->subject_text }}</div>

                    <div class="subtitle">{{ \App\Http\Support\Format::datetime($study->created_at, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

                </div>

            </div>

            <div id="actions">

                @if($button_contact_host ?? false)

                    <div class="button icon">

                        <img class="icon" src="/images/contact.svg">

                        <div class="text">Contacteer {{ $study->getHost->getPerson->first_name }}</div>

                    </div>

                @endif

            </div>

            <div id="content">

                <div class="content-columns">

                    <div class="column left">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @switch($study->service)

                                    @case(\App\Http\Traits\ServiceTrait::$ID_PRIVELES)

                                        @include('block.study-participants-priveles')

                                        @include('block.study-details')

                                        @include('block.study-location')

                                    @break

                                    @case(\App\Http\Traits\ServiceTrait::$ID_GROEPSLES)

                                        @include('block.study-participants-groepsles')

                                        @include('block.study-details')

                                        @include('block.study-location')

                                    @break

                                @endswitch

                            @break

                            @default

                                @switch($study->service)

                                    @case(\App\Http\Traits\ServiceTrait::$ID_PRIVELES)

                                        @include('block.study-host-priveles')

                                        @include('block.study-details')

                                    @break

                                    @case(\App\Http\Traits\ServiceTrait::$ID_GROEPSLES)

                                        @include('block.study-details')

                                        @include('block.study-location')

                                    @break

                                    @case(\App\Http\Traits\ServiceTrait::$ID_COLLEGE)

                                        @include('block.study-details')

                                        @include('block.study-location')

                            @endswitch

                        @endswitch

                    </div>

                    <div class="column right">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @switch($study->service)

                                    @case(\App\Http\Traits\ServiceTrait::$ID_PRIVELES)

                                        @include('block.study-report')

                                    @break

                                    @case(\App\Http\Traits\ServiceTrait::$ID_GROEPSLES)

                                        @include('block.study-report')

                                    @break

                                @endswitch

                            @break;

                            @default

                                @switch($study->service)

                                    @case(\App\Http\Traits\ServiceTrait::$ID_PRIVELES)

                                        @include('block.study-participants-priveles')

                                        @include('block.study-location')

                                    @break

                                    @case(\App\Http\Traits\ServiceTrait::$ID_GROEPSLES)

                                        @include('block.study-host-groepsles')

                                        @include('block.study-participants-groepsles')

                                    @break

                                    @case(\App\Http\Traits\ServiceTrait::$ID_COLLEGE)

                                        @include('block.study-host-college')

                                        @include('block.study-participants-college')

                                @endswitch

                        @endswitch

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
