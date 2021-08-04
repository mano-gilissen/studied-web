@foreach($filters as $column => $value) {

    <div class="button icon-reverse">

        <img class="icon" src="/images/close.svg">

        <div class="text">{{ $filter->column }}:{{ $filter->value }}</div>

    </div>

@endforeach
