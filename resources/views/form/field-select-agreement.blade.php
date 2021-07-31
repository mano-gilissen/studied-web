<div class="agreements">

    <div class="buttons">

        <img class="button" id="button-previous" src="/images/back.svg"/>

        <img class="button" id="button-next" src="/images/forward.svg"/>

    </div>

    <div class="wrap">

        <div id="agreements">

            @include('load.agreements', ['user' => $host ?? false])

        </div>

    </div>

</div>
