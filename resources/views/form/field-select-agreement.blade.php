<div id="agreements" class="agreements">

    @if($host ?? false)

        @include('load.agreements', ['user' => $host])

    @endif

</div>
