<div class="block-users">

    <div class="title">Leerlingen</div>

    <div class="list-users">

        @if($person->getUser->getStudents->count() > 0)

            @foreach($person->getUser->getStudents as $student)

                @include('block.person', ['person' => $student->getPerson])

            @endforeach

        @else

            <div class="block-note">{{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }} heeft geen leerlingen</div>

        @endif

    </div>

</div>
