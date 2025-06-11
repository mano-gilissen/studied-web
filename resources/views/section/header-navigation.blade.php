@if($navigation ?? true)

    @if($page_back ?? false)

        <img class="back" id="button-back" src="/images_app/back.svg" onclick="@if($back_route ?? false)  navigate('{{ route($back_route) }}'); @else window.history.back(); @endif"/>

    @else

        <img class="menu" id="button-menu" src="/images_app/menu.svg"/>

    @endif

@else

    <div id="button-none"></div>

@endif

<div style="display: flex">

    <div class="title page">{{ $page_title }}</div>

    <div class="title page dot">.</div>

</div>
