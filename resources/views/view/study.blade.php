@extends('app')



@section('css')

    <link href="{{ asset('css/study_210525.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="{{ asset('js/study_210525.js') }}"></script>

@endsection



@section('content')

    @include('section.header', ['back_route' => 'study.list'])

    @include('section.menu')

    <div id="wrap" data-status="{{ $study->{\App\Http\Support\Model::$STUDY_STATUS} }}">

        <div id="column">

            <div id="banner" style="background-image:url({{url('images_banner/' . \App\Http\Traits\StudyTrait::getBanner($study))}})">

                <div>

                    <div class="title">{{ __($study->{\App\Http\Support\Model::$STUDY_SUBJECT_TEXT}) }}</div>

                    <div class="subtitle">{{ \App\Http\Support\Format::datetime($study->start, \App\Http\Support\Format::$DATETIME_SINGLE) }}@if($study->{\App\Http\Support\Model::$STUDY_TRIAL})<span> - {{ __('Proefles') }}</span>@endif</div>

                </div>

            </div>

            <div id="actions">

                @switch($study->{\App\Http\Support\Model::$STUDY_STATUS})

                    @case(\App\Http\Traits\StudyTrait::$STATUS_PLANNED)

                        @if(\App\Http\Traits\StudyTrait::canEdit($study))

                            <div class="button icon grey" onclick="navigate('{{ route('study.edit', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}')">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Bewerken') }}</div>

                            </div>

                        @else

                            @include('section.contact-popout', ['user' => $study->getHost])

                        @endif

                        @if(\App\Http\Traits\StudyTrait::hasStarted($study))

                        @if(\App\Http\Traits\StudyTrait::canReport($study))

                            @if(!\App\Http\Traits\StudyTrait::isReported($study))

                                <div class="button icon" onclick="navigate('{{ route(\App\Http\Support\Route::REPORT_CREATE, [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}')">

                                    <img class="icon" src="/images_app/contact.svg">

                                    <div class="text">{{ __('Rapporteren') }}</div>

                                </div>

                            @endif

                        @endif

                    @endif

                        @break

                    @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                        @if(\App\Http\Traits\StudyTrait::canReport_Edit($study))

                            <div class="button icon" onclick="navigate('{{ route(\App\Http\Support\Route::REPORT_EDIT, [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}')">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Rapport wijzigen') }}</div>

                            </div>

                        @elseif($study->{\App\Http\Support\Model::$STUDY_HOST_USER} == Auth::id())



                        @else

                            @include('section.contact-popout', ['user' => $study->getHost])

                        @endif

                        @break

                    @case(\App\Http\Traits\StudyTrait::$STATUS_CANCELLED)

                    @case(\App\Http\Traits\StudyTrait::$STATUS_ABSENT)

                        @if(\App\Http\Traits\StudyTrait::canEdit($study))

                            <div class="button icon" onclick="navigate('{{ route('study.edit', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}')">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Bewerken') }}</div>

                            </div>

                        @else

                            @include('section.contact-popout', ['user' => $study->getHost])

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

                                        @include('section.study-participants-priveles')

                                        @break

                                    @default

                                        @include('section.study-participants-groepsles')

                                        @break

                                @endswitch

                                @include('section.study-details')

                                @include('section.study-location')

                            @break

                            @default

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('section.study-host-priveles')

                                        @break

                                    @case(2)
                                    @case(3)
                                    @case(4)
                                    @case(5)

                                        @include('section.study-details')

                                        @include('section.study-location')

                                        @break

                                    @default

                                        @include('section.study-details')

                                        @include('section.study-location')

                                        @break

                            @endswitch

                        @endswitch

                    </div>

                    <div class="column right">

                        @switch($study->status)

                            @case(\App\Http\Traits\StudyTrait::$STATUS_REPORTED)

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('section.study-report')

                                        @break

                                    @default

                                        @include('section.study-report')

                                        @break

                                @endswitch

                            @break

                            @default

                                @switch($study->getParticipants_User->count())

                                    @case(1)

                                        @include('section.study-participants-priveles')

                                        @break

                                    @case(2)
                                    @case(3)
                                    @case(4)
                                    @case(5)

                                        @include('section.study-host-groepsles')

                                        @include('section.study-participants-groepsles')

                                        @break

                                    @default

                                        @include('section.study-host-college')

                                        @include('section.study-participants-college')

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

                                        @include('section.study-details')

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

                                        @include('section.study-location')

                                        @break

                                @endswitch

                        @endswitch

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
