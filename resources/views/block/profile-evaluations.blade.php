<div class="evaluations">

    <div class="title">Gesprekken</div>

    <div id="list">

        <div id="headers" style="grid-template-columns: 2fr 3fr 3fr 3fr">

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

                    <div class="item @if($loop->odd) odd @endif" style="grid-template-columns: 2fr 3fr 3fr 3fr" onclick="window.location.href='{{ route('evaluation.view', ['id' => $evaluation->id]) }}'">

                        <div class="attribute">

                            <div>{{ \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_LIST) }}</div>

                        </div>

                        <div class="attribute">

                            <div>{{ \App\Http\Traits\PersonTrait::getFullName($evaluation->getHost->getPerson) }}</div>

                        </div>

                        <div class="attribute">

                            <div>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_LOCATION_TEXT} }}</div>

                        </div>

                        <div class="attribute">

                            <div>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING} }}</div>

                        </div>

                        <img class="action" src="{{ $action ?? '/images/chevron-right.svg' }}"/>

                    </div>

                @endforeach

            @endempty

        </div>

    </div>

</div>
