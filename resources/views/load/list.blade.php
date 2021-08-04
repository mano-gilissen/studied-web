<script>

    data_sort                           = JSON.parse('{!! $data_sort ?? '{}' !!}');
/*
    var data_sort                       = '{{ $data_sort }}';
    var data_filter                     = '{{ $data_filter }}';
*/
</script>

<div id="headers" style="grid-template-columns: {{ $column_spacing }}">

    @foreach($columns as $column)

        <div class="header {{ $column->state ?? '' }}" id="{{ $column->id }}">

            {{ $column->label }}

            <div class="sort"></div>

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
