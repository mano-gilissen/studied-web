<div class="block-users">

    <div class="title">{{ __('Leerling') }}</div>

    @foreach($study->getParticipants_User as $participant)

        @include('component.person', ['person' => $participant->getPerson, 'size' => 'large'])

        @break

    @endforeach

</div>
