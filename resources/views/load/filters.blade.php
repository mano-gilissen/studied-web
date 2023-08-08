@foreach($filters as $filter)

    @if (!in_array($filter->column, \App\Http\Support\Table::FILTERS_NO_DISPLAY))

        <div id="{{ $filter->id }}" class="button icon filter">

            <img class="icon" src="/images_app/close.svg">

            <div class="text">{{ $filter->column }} : {{ $filter->value }}</div>

        </div>

    @endif

@endforeach
