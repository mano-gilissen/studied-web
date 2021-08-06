@foreach($counters as $counter)

    <div class="counter" @if($loop->first) style="margin-left:0" @endif>

        <div class="label">{{ $counter->label }}</div>

        <div class="value">{{ $counter->value }}</div>

    </div>

@endforeach
