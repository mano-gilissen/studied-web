@extends('app')



@section('css')

    <link href="{{ asset('css/evaluation.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="{{ asset('js/evaluation.js') }}"></script>

@endsection



@section('content')

    @include('block.header')

    @empty($back)

        @include('block.menu')

    @endempty

    <div id="wrap">

        <div id="column">

            <div id="top">

                <img src="/images_app/evaluation_evaluation.jpg">

                <div class="title">{{ \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}) }}</div>

                <div class="subtitle">{{ \App\Http\Support\Format::datetime($evaluation->datetime, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

            </div>

            <div id="actions">

                @switch(Auth::user()->role)

                    @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                    @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                    @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                        <div class="button icon @if(!$evaluation->performed) grey @endif">

                            <img class="icon" src="/images_app/edit.svg">

                            <div class="text">Bewerken</div>

                        </div>

                        @if(!$evaluation->performed)

                            @switch($evaluation->regarding)

                                @case(\App\Http\Traits\EvaluationTrait::$ID_INTAKE)

                                    <div class="button icon" onclick="window.location.href='{{ route('evaluation.intake', ['key' => $evaluation->key]) }}'">

                                        <img class="icon" src="/images_app/contact.svg">

                                        <div class="text">Kennismaking</div>

                                    </div>

                                    @break

                                @case(\App\Http\Traits\EvaluationTrait::$ID_EVALUATION)

                                    <div class="button icon" onclick="window.location.href='{{ route('evaluation.evaluation', ['key' => $evaluation->key]) }}'">

                                        <img class="icon" src="/images_app/contact.svg">

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

                        <div class="block-users">

                            <div class="title">Aanwezigen</div>

                            <div class="list-users">

                                @include('block.person', ['person' => $evaluation->getHost->getPerson, 'subtitle' => 'Managing-student'])

                                @foreach($evaluation->getEmployees as $employee)

                                    @include('block.person', ['person' => $employee->getPerson, 'subtitle' => 'Student-docent'])

                                @endforeach

                            </div>

                        </div>

                    </div>

                    <div class="column right">

                        <div class="block-users">

                            <div class="no-title"></div>

                            <div class="list-users">

                                @include('block.person', ['person' => $evaluation->getStudent->getPerson, 'subtitle' => 'Leerling'])

                                @if($evaluation->getStudent->getStudent->getCustomer)

                                    @include('block.person', ['person' => $evaluation->getStudent->getStudent->getCustomer->getUser->getPerson, 'subtitle' => 'Ouder/verzorger'])

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

                @if($evaluation->performed)

                    <div class="column wide">

                        @include('block.evaluation-pva')

                        @include('block.evaluation-agreements')

                    </div>

                @endif

                <div class="content-columns">

                    <div class="column left">

                        @include('block.evaluation-details')

                    </div>

                    <div class="column right">

                        @include('block.evaluation-location')

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
