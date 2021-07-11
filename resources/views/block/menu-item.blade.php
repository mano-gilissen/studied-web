<div class="item" @isset($route)onclick="window.location.href='{{ route($route) }}'"@endisset >

    <div class="label">{{ $label }}</div>

    <img src="/images/back.svg" style="rotation: 180deg"/>

</div>
