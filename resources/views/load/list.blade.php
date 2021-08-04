<div id="headers" style="grid-template-columns: {{ $column_spacing }}">

    @foreach($columns as $column)

        <div>

            <div class="header {{ $column->sort }} {{ $column->filter }}" id="{{ $column->id }}">

                {{ $column->label }}

                <div class="sort"></div>

            </div>

            <div class="filter" id="filter_{{ $column->id }}">

                @switch($column->id)

                    @case(\App\Http\Controllers\StudyController::$COLUMN_HOST)

                        @include('form.box-input', ['id' => 'filter_input_' . $column->id, 'identifier' => $column->id, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'form' => false, 'trigger' => 'filter'])

                        @break

                @endswitch

            </div>

        </div>

    @endforeach

    <div></div>

</div>

<div id="items">

    @foreach($items as $item)

        <div class="item @if($loop->odd) odd @endif" style="grid-template-columns: {{ $column_spacing }}" onclick="window.location.href='{{ $item->link ?? '' }}'">

            @foreach($columns as $column)

                <div class="attribute">

                    <div>@if($column->html){!! $item->{$column->id} !!}@else{{ $item->{$column->id} }}@endif</div>

                </div>

            @endforeach

            <img class="action" src="{{ $action ?? '/images/chevron-right.svg' }}"/>

        </div>

    @endforeach

</div>
