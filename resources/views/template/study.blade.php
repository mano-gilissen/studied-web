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

                @switch($study)

                    @case(\App\Http\Traits\StudyTrait::$STATUS_CREATED)

                        @if(\App\Http\Traits\StudyTrait::hasFinished($study))

                            @if(\App\Http\Traits\StudyTrait::canReport($study))

                                <div class="button icon">

                                    <img class="icon" src="/images/edit.svg">

                                    <div class="text">Rapporteren</div>

                                </div>

                            @else

                                <div class="button icon">

                                    <img class="icon" src="/images/contact.svg">

                                    <div class="text">Contacteer {{ $study->getHost->getPerson->first_name }}</div>

                                </div>

                            @endif

                        @else

                            @if(\App\Http\Traits\StudyTrait::canEdit($study))

                                <div class="button icon">

                                    <img class="icon" src="/images/edit.svg">

                                    <div class="text">Bewerken</div>

                                </div>

                            @else

                                <div class="button icon">

                                    <img class="icon" src="/images/contact.svg">

                                    <div class="text">Contacteer {{ $study->getHost->getPerson->first_name }}</div>

                                </div>

                            @endif

                        @endif

                        @break

                    @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                        @if(\App\Http\Traits\StudyTrait::canReport_Edit($study))

                            <div class="button icon">

                                <img class="icon" src="/images/edit.svg">

                                <div class="text">Rapport wijzigen</div>

                            </div>

                        @elseif($study->{\App\Http\Support\Model::$STUDY_HOST_USER} == Auth::id())



                        @else

                            <div class="button icon">

                                <img class="icon" src="/images/contact.svg">

                                <div class="text">Contacteer {{ $study->getHost->getPerson->first_name }}</div>

                            </div>

                        @endif

                        @break

                    @case(\App\Http\Traits\StudyTrait::$STATUS_CANCELLED)

                        @if(\App\Http\Traits\StudyTrait::canReport_Edit($study))

                            <div class="button icon red">

                                <img class="icon" src="/images/trash-white.svg">

                                <div class="text">Verwijderen</div>

                            </div>

                        @endif

                @endswitch

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
