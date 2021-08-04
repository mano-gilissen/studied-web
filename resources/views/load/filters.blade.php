@foreach($filters as $filter)

    <div id="{{ $filter->id }}" class="button icon filter">

        <img class="icon" src="/images/close.svg">

        <div class="text">{{ $filter->column }}:{{ $filter->value }}</div>

    </div>

@endforeach
