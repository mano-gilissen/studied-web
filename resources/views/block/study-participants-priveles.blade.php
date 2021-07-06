<div class="block-users">

    <div class="title">Deelnemers</div>

    @foreach($participants as $participant)

        @include('block.user', ['user' => $participant, 'size' => 'large'])

        @break

    @endforeach

</div>
