@foreach($filters as $filter)

    <div class="button icon-reverse">

        <img class="icon" src="/images/close.svg">

        <div class="text">{{ $filter->display }}</div>

    </div>

@endforeach
