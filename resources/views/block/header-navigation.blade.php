@if($page_back ?? false)

    <img class="back" src="/images/back.svg" onclick="window.history.back();"/>

@else

    <img class="menu" id="button-menu" src="/images/menu.svg"/>

@endif

<div style="display: flex">

    <div class="title page">{{ $page_title }}</div>

    <div class="dot">.</div>

</div>
