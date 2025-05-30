<div class="block-users">

    <div class="title">{{ __('Leerlingen') }}</div>

    <div class="list-users">

        @if($person->getUser->getCustomer->getStudents->count() > 0)

            @foreach($person->getUser->getCustomer->getStudents as $student)

                @include('component.person', ['person' => $student->getUser->getPerson])

            @endforeach

        @else

            <div class="block-note">{{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} . ' ' . __('heeft geen leerlingen') }}</div>

        @endif

    </div>

</div>
