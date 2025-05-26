<div class="evaluations">

    @if(\App\Http\Traits\BaseTrait::hasManagementRights() && $person->getUser->isStudent())

        <div class="title-add">

            <img class="button-add" src="/images_app/add-unboxed.svg" onclick="window.location.href='{{ route('evaluation.plan', ['leerling' => $person->slug]) }}'">

            <div class="title">{{ __('Gesprekken') }}</div>

        </div>

    @else

        <div class="title">{{ __('Gesprekken') }}</div>

    @endif

    @php $evaluations = \App\Http\Traits\UserTrait::getEvaluations($person->getUser); @endphp

    @if(count($evaluations) > 0)

        <div id="list">

            <div id="headers">

                <div class="header no_sort no_filter">{{ __('Datum') }}</div>

                <div class="header no_sort no_filter">{{ __('Ingepland door') }}</div>

                <div class="header no_sort no_filter">{{ __('Locatie') }}</div>

                <div class="header no_sort no_filter">{{ __('Betreft') }}</div>

            </div>

            <div id="items">

                @empty($evaluations)

                    <div class="no-items">{{ $person->first_name . __(' heeft nog geen gesprekken.') }}</div>

                @else

                    @foreach($evaluations as $evaluation)

                        <div class="item @if($loop->odd) odd @endif" onclick="window.location.href='{{ route('evaluation.view', ['key' => $evaluation->{\App\Http\Support\Model::$BASE_KEY}]) }}'">

                            <div class="attribute">

                                <div style="font-weight: 400">{{ \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_LIST) }}</div>

                            </div>

                            <div class="attribute">

                                <div>{{ \App\Http\Traits\PersonTrait::getFullName($evaluation->getHost->getPerson) }}</div>

                            </div>

                            <div class="attribute">

                                <div>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_LOCATION_TEXT} }}</div>

                            </div>

                            <div class="attribute regarding">

                                <div>{{ \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}) }}</div>

                            </div>

                            <div class="end">

                                <img class="action" src="{{ $action ?? '/images_app/chevron-right.svg' }}"/>

                                @if(!\App\Http\Support\Func::has_passed($evaluation->datetime))

                                    <div class="attention"></div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                @endempty

            </div>

        </div>

    @else

        <div class="block-note">{{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} . __(' heeft nog geen gesprekken.') }}</div>

    @endif

</div>
