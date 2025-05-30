@extends('app')



@section('css')

    <link href="{{ asset('css/agreement_210525.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('section.header')

    @include('section.menu')

    <div id="wrap">

        <div id="column">

            <div id="top">

                <img src="/images_app/agreement.jpg">

                <div class="title">{{ __('Vakafspraak') }}</div>

                <div class="subtitle">{{ __($agreement->getService->{\App\Http\Support\Model::$SERVICE_SHORT}) . " " . __($agreement->getSubject->{\App\Http\Support\Model::$SUBJECT_NAME}) }}</div>

            </div>

            <div id="actions">

                @switch(Auth::user()->role)

                    @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                    @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                    @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                        @if($agreement->{\App\Http\Support\Model::$AGREEMENT_STATUS} == \App\Http\Traits\AgreementTrait::$STATUS_ACTIVE)

                            <div class="button icon grey" onclick="window.location.href='{{ route('agreement.finish', [\App\Http\Support\Model::$AGREEMENT_IDENTIFIER => $agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}]) }}'">

                                <img class="icon" src="/images_app/edit.svg">

                                <div class="text">{{ __('Afhandelen') }}</div>

                            </div>

                        @endif

                        <div class="button icon" onclick="window.location.href='{{ route('agreement.edit', [\App\Http\Support\Model::$AGREEMENT_IDENTIFIER => $agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}]) }}'">

                            <img class="icon" src="/images_app/edit.svg">

                            <div class="text">{{ __('Bewerken') }}</div>

                        </div>

                    @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)
                    @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)
                    @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                        @break

                @endswitch

            </div>

            <div id="content">

                <div class="content-columns">

                    <div class="column left">

                        <div class="block-users">

                            <div class="title">{{ __('Student-docent') }}</div>

                            <div class="list-users">

                                @include('section.person', ['person' => $agreement->getEmployee->getPerson])

                            </div>

                        </div>

                        @include('section.agreement-details-1')

                    </div>

                    <div class="column right">

                        <div class="block-users">

                            <div class="title">{{ __('Leerling') }}</div>

                            <div class="list-users">

                                @include('section.person', ['person' => $agreement->getStudent->getPerson])

                            </div>

                        </div>

                        @include('section.agreement-details-2')

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
