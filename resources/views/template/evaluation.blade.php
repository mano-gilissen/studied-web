@extends('app')



@section('css')

    <link href="{{ asset('css/evaluation.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    @empty($back)

        @include('block.menu')

    @endempty

    <div id="wrap">

        <div id="column">

            <div id="top">

                <div id="banner" style="background:#999999">

                    <div>

                        <div class="title">{{ \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}) }}</div>

                        <div class="subtitle">{{ \App\Http\Support\Format::datetime($evaluation->datetime, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

                    </div>

                </div>

            </div>

            <div id="actions">

                @switch(Auth::user()->role)

                    @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                    @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                    @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                        <div class="button icon grey">

                            <img class="icon" src="/images/edit.svg">

                            <div class="text">Bewerken</div>

                        </div>

                        @if(!$evaluation->performed)

                            @switch($evaluation->regarding)

                                @case(\App\Http\Traits\EvaluationTrait::$ID_INTAKE)

                                    <div class="button icon" onclick="window.location.href='{{ route('evaluation.intake', ['key' => $evaluation->key]) }}'">

                                        <img class="icon" src="/images/contact.svg">

                                        <div class="text">Kennismaking</div>

                                    </div>

                                    @break

                                @case(\App\Http\Traits\EvaluationTrait::$ID_EVALUATION)

                                    <div class="button icon" onclick="window.location.href='{{ route('evaluation.evaluation', ['key' => $evaluation->key]) }}'">

                                        <img class="icon" src="/images/contact.svg">

                                        <div class="text">Evaluatie</div>

                                    </div>

                                    @break

                            @endswitch

                        @endif

                        @break

                    @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)
                    @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)
                    @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                        @break

                @endswitch

            </div>

            <div id="content">

                <div class="content-columns">

                    <div class="column left">

                        @if($evaluation->performed)

                            @include('block.evaluation-details')

                        @else

                            @include('block.evaluation-details')

                            @include('block.evaluation-location')

                        @endif

                    </div>

                    <div class="column right">

                        <div class="block-users">

                            <div class="title">{{ \App\Http\Traits\EvaluationTrait::getRegardingVerbText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}) }} met</div>

                            <div class="list-users">

                                @include('block.person', ['person' => $evaluation->getStudent->getPerson, 'subtitle' => 'Leerling'])

                                @if($evaluation->getStudent->getStudent->getCustomer)

                                    @include('block.person', ['person' => $evaluation->getStudent->getStudent->getCustomer->getUser->getPerson, 'subtitle' => 'Ouder/verzorger'])

                                @endif

                            </div>

                        </div>

                        <div class="block-users">

                            <div class="title">Gesprek met</div>

                            <div class="list-users">

                                @include('block.person', ['person' => $evaluation->getHost->getPerson, 'subtitle' => 'Managing-student'])

                                @foreach($evaluation->getEmployees as $employee)

                                    @include('block.person', ['person' => $employee->getPerson, 'subtitle' => 'Student-docent'])

                                @endforeach

                            </div>

                        </div>

                    </div>

                    @if($evaluation->performed)

                        <div class="column wide">

                            @include('block.evaluation-pva')

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
