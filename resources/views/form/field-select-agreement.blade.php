<div class="agreements">

    <div class="wrap">

        <div id="agreements">

            @if($host ?? false)

                @include('load.agreements', ['user' => $host])

            @endif

        </div>

    </div>

</div>
