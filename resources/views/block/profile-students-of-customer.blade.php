<div class="block-users">

    <div class="title">Leerlingen</div>

    <div class="list-users">

        @foreach($person->getUser->getCustomer->getStudents as $student)

            @include('block.person', ['person' => $student->getUser->getPerson])

        @endforeach

    </div>

</div>
