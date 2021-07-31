<div class="agreements">

    <div class="buttons">

        <div class="button" id="button-previous"></div>

        <div class="button" id="button-next"></div>

    </div>

    <div class="wrap">

        <div id="agreements">

            @if($host ?? false)

                @include('load.agreements', ['user' => $host])

            @endif

        </div>

    </div>

</div>
