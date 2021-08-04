@foreach($filters as $column => $value)

    <div class="button icon">

        <img class="icon" src="/images/close.svg">

        <div class="text">{{ $column }}:{{ $value }}</div>

    </div>

@endforeach
