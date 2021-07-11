<div class="item" @isset($route)onclick="window.location.href='{{ route($route) }}'"@endisset >

    <div class="label">{{ $label }}</div>

    <img src="/images/forward.svg"/>

</div>
