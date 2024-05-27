@extends('app')



@section('css')

    <link href="{{ asset('css/study_100823.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="{{ asset('js/study_100823.js') }}"></script>

@endsection



@section('content')

    @include('block.header')

    @include('block.menu')

    <div id="wrap">

        <div id="column">

            <div id="banner" style="background-image:url({{url('images_banner/' . \App\Http\Traits\StudyTrait::getBanner($study))}})">

                <div>

                    <div class="title">{{ $study->{\App\Http\Support\Model::$STUDY_SUBJECT_TEXT} }}</div>

                    <div class="subtitle">{{ \App\Http\Support\Format::datetime($study->start, \App\Http\Support\Format::$DATETIME_SINGLE) }}@if($study->{\App\Http\Support\Model::$STUDY_TRIAL})<span> - {{ __('Proefles') }}</span>@endif</div>

                </div>

            </div>

            <div id="actions">

                @switch($study->{\App\Http\Support\Model::$STUDY_STATUS})

                    @case(\App\Http\Traits\StudyTrait::$STATUS_PLANNED)

                        @if(\App\Http\Traits\StudyTrait::canEdit($study))

                            <div class="button icon grey" onclick="window.location.href='{{ route('study.edit', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}'">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Bewerken') }}</div>

                            </div>

                        @else

                            @include('block.contact-popout', ['user' => $study->getHost])

                        @endif

                        @if(\App\Http\Traits\StudyTrait::hasStarted($study))

                        @if(\App\Http\Traits\StudyTrait::canReport($study))

                            @if(!\App\Http\Traits\StudyTrait::isReported($study))

                                <div class="button icon" onclick="window.location.href='{{ route(\App\Http\Support\Route::REPORT_CREATE, [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}'">

                                    <img class="icon" src="/images_app/contact.svg">

                                    <div class="text">{{ __('Rapporteren') }}</div>

                                </div>

                            @endif

                        @endif

                    @endif

                        @break

                    @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                        @if(\App\Http\Traits\StudyTrait::canReport_Edit($study))

                            <div class="button icon" onclick="window.location.href='{{ route(\App\Http\Support\Route::REPORT_EDIT, [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}'">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Rapport wijzigen') }}</div>

                            </div>

                        @elseif($study->{\App\Http\Support\Model::$STUDY_HOST_USER} == Auth::id())



                        @else

                            @include('block.contact-popout', ['user' => $study->getHost])

                        @endif

                        @break

                    @case(\App\Http\Traits\StudyTrait::$STATUS_CANCELLED)

                    @case(\App\Http\Traits\StudyTrait::$STATUS_ABSENT)

                        @if(\App\Http\Traits\StudyTrait::canEdit($study))

                            <div class="button icon" onclick="window.location.href='{{ route('study.edit', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}'">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Bewerken') }}</div>

                            </div>

                        @else

                            @include('block.contact-popout', ['user' => $study->getHost])

                        @endif

                        @break

                @endswitch

            </div>

            <div id="content">

                <div class="content-columns">

                    <div class="column left">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('block.study-participants-priveles')

                                        @break

                                    @default

                                        @include('block.study-participants-groepsles')

                                        @break

                                @endswitch

                                @include('block.study-details')

                                @include('block.study-location')

                            @break

                            @default

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('block.study-host-priveles')

                                        @break

                                    @case(2)
                                    @case(3)
                                    @case(4)
                                    @case(5)

                                        @include('block.study-details')

                                        @include('block.study-location')

                                        @break

                                    @default

                                        @include('block.study-details')

                                        @include('block.study-location')

                                        @break

                            @endswitch

                        @endswitch

                    </div>

                    <div class="column right">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('block.study-report')

                                        @break

                                    @default

                                        @include('block.study-report')

                                        @break

                                @endswitch

                            @break

                            @default

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('block.study-participants-priveles')

                                        @break

                                    @case(2)
                                    @case(3)
                                    @case(4)
                                    @case(5)

                                        @include('block.study-host-groepsles')

                                        @include('block.study-participants-groepsles')

                                        @break

                                    @default

                                        @include('block.study-host-college')

                                        @include('block.study-participants-college')

                                        @break

                                @endswitch

                        @endswitch

                    </div>

                </div>

                <div class="content-columns">

                    <div class="column left">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @break

                            @default

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('block.study-details')

                                        @break

                                @endswitch

                        @endswitch

                    </div>

                    <div class="column right">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @break

                            @default

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('block.study-location')

                                        @break

                                @endswitch

                        @endswitch

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
