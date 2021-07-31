<div class="agreements">

    <div class="buttons">

        <img class="button" id="button-previous" src="/images/back.svg"/>

        <img class="button" id="button-next" src="/images/forward.svg"/>

    </div>

    <div class="wrap">

        <div id="agreements">

            @if($host ?? false)

                @include('load.agreements', ['user' => $host])

            @endif

        </div>

    </div>

</div>
