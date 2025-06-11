@foreach($items as $item)

    <div class="item" onclick="navigate('{{ $item->link ?? '' }}')">

        @foreach($columns as $column)

            @if($column->spacing > 1)

                <div class="attribute big">

                    <div class="value">@if($column->html){!! __($item->{$column->id}) !!}@else{{ __($item->{$column->id}) }}@endif</div>

                </div>

                <div></div>

            @else

                <div class="attribute">

                    <div class="label">{{ $column->label }}</div>

                    <div class="value">@if($column->html){!! __($item->{$column->id}) !!}@else{{ __($item->{$column->id}) }}@endif</div>

                </div>

            @endif

        @endforeach

    </div>

@endforeach
