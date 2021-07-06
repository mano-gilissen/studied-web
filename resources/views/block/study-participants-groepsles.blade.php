<div class="block-users">

    <div class="title">Deelnemers</div>

    <div class="list-users">

        @foreach($participants as $participant)

            @include('block.person', ['person' => $participant->getPerson])

        @endforeach

    </div>

</div>
