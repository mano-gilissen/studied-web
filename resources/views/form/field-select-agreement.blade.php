<div id="agreements" class="agreements">

    @if($host ?? false)

        @include('load.field-select-agreement', ['user' => $host])

    @endif

</div>
