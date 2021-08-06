<div class="block-users">

    <div class="title">Deelnemers ({{\App\Http\Traits\StudyTrait::countParticipants($study)}})</div>

    <div class="list-users grid">

        @foreach(\App\Http\Traits\StudyTrait::getParticipants_Person($study) as $person)

            @include('block.person', ['person' => $person])

        @endforeach

    </div>

</div>
