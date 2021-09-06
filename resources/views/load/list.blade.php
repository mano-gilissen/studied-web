<div id="headers" style="grid-template-columns: {{ $column_spacing }}">

    @foreach($columns as $column)

        <div>

            <div class="header {{ $column->sort }} {{ $column->filter }}" id="{{ $column->id }}">

                {{ $column->label }}

                <div class="sort"></div>

            </div>

            <div class="filter" id="filter_{{ $column->id }}">

                @if($column->filter != \App\Http\Support\Table::FILTER_DISABLED)

                    @switch($column->id)

                        @case(\App\Http\Controllers\StudyController::$COLUMN_DATE)

                            @include('form.field-input', ['id' => 'filter_input_' . $column->id . '_after', 'identifier' => $column->id, 'type' => 'date', 'form' => false, 'trigger' => 'filter'])

                            <div class="note">tot</div>

                            @include('form.field-input', ['id' => 'filter_input_' . $column->id . '_before', 'identifier' => $column->id, 'type' => 'date', 'form' => false, 'trigger' => 'filter'])

                            @break

                        @case(\App\Http\Controllers\CustomerController::$COLUMN_STATUS)

                            @include('form.box-input', ['id' => 'filter_input_' . $column->id, 'identifier' => $column->id, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'form' => false, 'trigger' => 'filter'])

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

        <div class="no-items">Er zijn geen resultaten gevonden.</div>

    @else

        @foreach($items as $item)

            <div class="item @if($loop->odd) odd @endif" style="grid-template-columns: {{ $column_spacing }}" onclick="window.location.href='{{ $item->link ?? '' }}'">

                @foreach($columns as $column)

                    <div class="attribute">

                        <div>@if($column->html){!! $item->{$column->id} !!}@else{{ $item->{$column->id} }}@endif</div>

                    </div>

                @endforeach

                <img class="action" src="{{ $action ?? '/images_app/chevron-right.svg' }}"/>

            </div>

        @endforeach

    @endempty

</div>
