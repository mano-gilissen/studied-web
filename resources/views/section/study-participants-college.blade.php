<div class="block-users">

    <div class="title">{{ __('Deelnemers') }} ({{\App\Http\Traits\StudyTrait::countParticipants($study)}})</div>

    <div class="list-users grid">

        @foreach(\App\Http\Traits\StudyTrait::getParticipants_Person($study) as $person)

            @include('component.person', ['person' => $person, 'size' => 'grid'])

        @endforeach

    </div>

</div>
