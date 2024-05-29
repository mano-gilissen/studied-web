<div class="language-select" onclick="$(this).toggleClass('open')">

    <img class="flag" src="/images_app/flag-{{ \App\Http\Middleware\Locale::getActive() }}.png"/>

    <div class="value">{{ \App\Http\Middleware\Locale::getActive_text() }}</div>

    <img class="chevron" src="/images_app/chevron-white-down.svg"/>

    <div class="options">

        @foreach(\App\Http\Middleware\Locale::getOptions() as $option)

            <div class="option" onclick="set_language('{{ $option }}')">{{ \App\Http\Middleware\Locale::getOption_text($option) }}</div>

        @endforeach

    </div>

</div>
