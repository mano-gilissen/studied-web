<div id="filters-mobile">

    <div id="filters-mobile-pick">

        <div id="filters-mobile-pick-top">

            <div class="label">{{ __('Filteren op') }}</div>

            <img src="/images_app/close-black.svg" onclick="filters_mobile_close()">

        </div>

        @foreach($columns as $column)

            @if($column->filter != \App\Http\Support\Table::FILTER_DISABLED)

                <div class="option" onclick="filters_mobile_open({{ $column->id }})">{{ __($column->label) }}</div>

            @endif

        @endforeach

    </div>

    @foreach($columns as $column)

        <div class="filter" id="filter_{{ $column->id }}">

            @if($column->filter != \App\Http\Support\Table::FILTER_DISABLED)

                @switch($column->id)

                    @case(\App\Http\Controllers\StudyController::$COLUMN_DATE)
                    @case(\App\Http\Controllers\AgreementController::$COLUMN_START)
                    @case(\App\Http\Controllers\AgreementController::$COLUMN_END)

                        @include('component.filter-date')

                        @break

                    @default

                        @include('component.box-input', ['id' => 'filter_input_' . $column->id, 'identifier' => $column->id, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'form' => false, 'trigger' => 'filter'])

                @endswitch

            @endif

        </div>

    @endforeach

</div>

<div id="sort-mobile">

    <div id="sort-mobile-pick">

        <div id="sort-mobile-pick-top">

            <div class="label">{{ __('Sorteren op') }}</div>

            <img src="/images_app/close-black.svg" onclick="sort_mobile_close()">

        </div>

        @foreach($columns as $column)

            @if($column->sort != \App\Http\Support\Table::SORT_DISABLED)

                <div class="option" onclick="sort_mobile_direction({{ $column->id }})">{{ __($column->label) }}</div>

            @endif

        @endforeach

    </div>

    <div id="sort-mobile-direction">

        <div class="label">{{ __('Sorteren op') }}</div>

        <div class="option" onclick="sort_mobile('asc')">{{ __('Oplopend') }}</div>

        <div class="option" onclick="sort_mobile('desc')">{{ __('Aflopend') }}</div>

    </div>

</div>

<div id="items">

    @empty($items)

        <div class="no-items">{{ __('Er zijn geen resultaten gevonden.') }}</div>

    @else

        @include('load.items-mobile')

    @endempty

    <div id="button-load-more" class="button load-more transparent icon">

        <img class="icon" src="/images_app/add.svg">

        <div class="text">{{ __('Meer laden') }}</div>

    </div>

</div>
