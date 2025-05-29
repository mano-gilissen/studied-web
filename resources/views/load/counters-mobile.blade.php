<div id="counters-mobile">

    <div id="counters-mobile-top">

        <div class="title">{{ __('Statistieken') }}</div>

        <img src="/images_app/close-black.svg" onclick="counters_mobile_close()">

    </div>

    @foreach($counters as $counter)

        <div @if($counter->id ?? false) id="{{ $counter->id }}" @endif class="counter" @if($loop->first) style="margin-left:0" @endif>

            <div class="label">{{ $counter->label }}</div>

            <div class="value">{{ $counter->value }}</div>

        </div>

    @endforeach

</div>
