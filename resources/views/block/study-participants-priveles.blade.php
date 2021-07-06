<div class="block-users">

    <div class="title">Leerling</div>

    @foreach($participants as $participant)

        @include('block.person', ['person' => $participant->getPerson, 'size' => 'large'])

        @break

    @endforeach

</div>
