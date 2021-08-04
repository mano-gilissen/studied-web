@foreach($filters as $column => $value)

    <div id="{{ $column }}" class="button icon filter">

        <img class="icon" src="/images/close.svg">

        <div class="text">{{ $column }}:{{ $value }}</div>

    </div>

@endforeach
