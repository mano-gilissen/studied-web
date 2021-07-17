<div class="block-users">

    <div class="title">Deelnemers</div>

    <div class="list-users">

        @foreach(\App\Http\Traits\StudyTrait::getParticipants_Person($study) as $person)

            <!-- TODO: CHANGE TO AVATAR GRID (LARGE AMOUNT OF PARTICIPANTS) -->

            @include('block.person', ['person' => $person])

        @endforeach

    </div>

</div>
