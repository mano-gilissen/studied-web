<div class="block-users">

    <div class="title">Leerlingen</div>

    <div class="list-users">

        @foreach($person->getUser->getEmployee->getStudents as $student)

            @include('block.person', ['person' => $student->getPerson])

        @endforeach

    </div>

</div>
