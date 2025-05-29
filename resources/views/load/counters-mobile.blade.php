<div id="counters-mobile">

    <img src="/images_app/close-black.svg" onclick="counters_mobile_close()">

    @foreach($counters as $counter)

        <div @if($counter->id ?? false) id="{{ $counter->id }}" @endif class="counter" @if($loop->first) style="margin-left:0" @endif>

            <div class="label">{{ $counter->label }}</div>

            <div class="value">{{ $counter->value }}</div>

        </div>

    @endforeach

</div>
