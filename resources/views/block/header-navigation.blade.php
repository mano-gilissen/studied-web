@if($page_back ?? false)

    <img class="back" id="button-back" src="/images_app/back.svg" onclick="window.history.back();"/>

@else

    <img class="menu" id="button-menu" src="/images_app/menu.svg"/>

@endif

<div style="display: flex">

    <div class="title page">{{ $page_title }}</div>

    <div class="title page dot">.</div>

</div>
