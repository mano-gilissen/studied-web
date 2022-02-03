@foreach($counters as $counter)

    <div @if($counter->id) id="{{ $counter->id }}" @endif class="counter" @if($loop->first) style="margin-left:0" @endif>

        <div class="label">{{ $counter->label }}</div>

        <div class="value">{{ $counter->value }}</div>

    </div>

@endforeach
