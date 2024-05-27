<div class="block-users">

    <div class="title">{{ __('Deelnemers') }}</div>

    <div class="list-users">

        @foreach($study->getParticipants_User as $participant)

            @include('block.person', ['person' => $participant->getPerson])

        @endforeach

    </div>

</div>
