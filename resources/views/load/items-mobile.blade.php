@foreach($items as $item)

    <div class="item" onclick="window.location.href='{{ $item->link ?? '' }}'">

        @foreach($columns as $column)

            <div class="attribute">

                <div class="label">{{ $column->label }}</div>

                <div class="value">@if($column->html){!! __($item->{$column->id}) !!}@else{{ __($item->{$column->id}) }}@endif</div>

            </div>

        @endforeach

    </div>

@endforeach
