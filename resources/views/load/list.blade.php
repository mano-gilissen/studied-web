<div id="headers" style="grid-template-columns: {{ $column_spacing }}">

    @foreach($columns as $column)

        <div>

            <div class="header {{ $column->sort }} {{ $column->filter }}" id="{{ $column->id }}">

                {{ $column->label }}

                @if($column->sort != \App\Http\Support\Table::SORT_DISABLED)

                    <div class="sort"></div>

                @endif

            </div>

            <div class="filter" id="filter_{{ $column->id }}">

                @if($column->filter != \App\Http\Support\Table::FILTER_DISABLED)

                    @switch($column->id)

                        @case(\App\Http\Controllers\StudyController::$COLUMN_DATE)
                        @case(\App\Http\Controllers\AgreementController::$COLUMN_START)
                        @case(\App\Http\Controllers\AgreementController::$COLUMN_END)

                            @include('block.filter-date')

                            @break

                        @default

                            @include('form.box-input', ['id' => 'filter_input_' . $column->id, 'identifier' => $column->id, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'form' => false, 'trigger' => 'filter'])

                    @endswitch

                @endif

            </div>

        </div>

    @endforeach

    <div></div>

</div>

<div id="items">

    @empty($items)

        <div class="no-items">{{ __('Er zijn geen resultaten gevonden.') }}</div>

    @else

        @include('load.items')

    @endempty

    <div id="button-load-more" class="button load-more transparent icon">

        <img class="icon" src="/images_app/add.svg">

        <div class="text">{{ __('Meer laden') }}</div>

    </div>

</div>
