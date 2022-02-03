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
