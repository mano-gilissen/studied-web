<div class="evaluations">

    @if(\App\Http\Traits\BaseTrait::hasManagementRights(Auth::user()) && $person->getUser->isStudent())

        <div class="title-add">

            <img class="button-add" src="/images/add-unboxed.svg" onclick="window.location.href='{{ route('evaluation.plan', ['student' => $person->getUser->getStudent->id]) }}'">

            <div class="title">Gesprekken</div>

        </div>

    @else

        <div class="title">Gesprekken</div>

    @endif

    <div id="list">

        <div id="headers" style="grid-template-columns: 1fr 1fr 1fr 1fr 48px">

            <div class="header no_sort no_filter">Datum</div>

            <div class="header no_sort no_filter">Host</div>

            <div class="header no_sort no_filter">Locatie</div>

            <div class="header no_sort no_filter">Onderwerp</div>

        </div>

        <div id="items">

            @php $evaluations = \App\Http\Traits\UserTrait::getEvaluations($person->getUser); @endphp

            @empty($evaluations)

                <div class="no-items">{{ $person->first_name }} heeft nog geen gesprekken.</div>

            @else

                @foreach($evaluations as $evaluation)

                    <div class="item @if($loop->odd) odd @endif" style="grid-template-columns: 1fr 1fr 1fr 1fr 48px" onclick="window.location.href='{{ route('evaluation.view', ['key' => $evaluation->{\App\Http\Support\Model::$BASE_KEY}]) }}'">

                        <div class="attribute">

                            <div style="font-weight: 400">{{ \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_LIST) }}</div>

                        </div>

                        <div class="attribute">

                            <div>{{ \App\Http\Traits\PersonTrait::getFullName($evaluation->getHost->getPerson) }}</div>

                        </div>

                        <div class="attribute">

                            <div>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_LOCATION_TEXT} }}</div>

                        </div>

                        <div class="attribute">

                            <div>{{ \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}) }}</div>

                        </div>

                        <div class="end">

                            <img class="action" src="{{ $action ?? '/images/chevron-right.svg' }}"/>

                            @if(!\App\Http\Support\Func::has_passed($evaluation->datetime))

                                <div class="attention"></div>

                            @endif

                        </div>

                    </div>

                @endforeach

            @endempty

        </div>

    </div>

</div>
