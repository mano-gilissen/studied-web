<div id="header">

    <img class="menu" src="/images/menu.svg" v-on:click="menu_toggle"/>

    <div class="title page">{{ $page_title }}<span class="dot">.</span></div>

    @include('block.header-user')

</div>
