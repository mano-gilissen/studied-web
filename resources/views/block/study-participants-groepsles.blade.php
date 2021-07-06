<div class="block-users">

    <div class="title">Deelnemers</div>

    <div class="list-users">

        @foreach($participants as $participant)

            @include('block.user', ['user' => $participant])

        @endforeach

    </div>

</div>
