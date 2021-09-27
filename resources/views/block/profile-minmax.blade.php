<div class="block-attributes">

    <div class="title">Afspraken</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Uren per week</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_MAX} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_MIN} . ' tot ' . $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_MAX} : 'Onbekend' }}</div>

        </div>

    </div>

</div>
