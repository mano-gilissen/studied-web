@extends('app')



@section('css')

    <link href="{{ asset('css/agreement.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    @empty($back)

        @include('block.menu')

    @endempty

    <div id="wrap">

        <div id="column">

            <div id="top">

                <img src="/images_app/agreement.jpg">

                <div class="title">Vakafspraak</div>

                <div class="subtitle">{{ $agreement->getSubject->{\App\Http\Support\Model::$SUBJECT_NAME} }}</div>

            </div>

            <div id="actions">

                @switch(Auth::user()->role)

                    @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                    @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                    @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                        @if($agreement->{\App\Http\Support\Model::$AGREEMENT_STATUS} == \App\Http\Traits\AgreementTrait::$STATUS_ACTIVE)

                            <div class="button icon grey">

                                <img class="icon" src="/images_app/edit.svg" onclick="window.location.href='{{ route('agreement.finish', [\App\Http\Support\Model::$AGREEMENT_IDENTIFIER => $agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}]) }}'">

                                <div class="text">Afhandelen</div>

                            </div>

                        @endif

                        <div class="button icon">

                            <img class="icon" src="/images_app/edit.svg">

                            <div class="text">Bewerken</div>

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

                            <div class="title">Student-docent</div>

                            <div class="list-users">

                                @include('block.person', ['person' => $agreement->getEmployee->getPerson])

                            </div>

                        </div>

                        @include('block.agreement-details-1')

                    </div>

                    <div class="column right">

                        <div class="block-users">

                            <div class="title">Leerling</div>

                            <div class="list-users">

                                @include('block.person', ['person' => $agreement->getStudent->getPerson])

                            </div>

                        </div>

                        @include('block.agreement-details-2')

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
