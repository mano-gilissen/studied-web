<div class="block-attributes">

    <div class="title">Onderwijs</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">School</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_SCHOOL} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_SCHOOL} : \App\Http\Support\Key::UNKNOWN }}</div>

        </div>

        <div class="attribute">

            <div class="name">Niveau</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NIVEAU} ? \App\Http\Traits\StudentTrait::getNiveauText($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NIVEAU}) : \App\Http\Support\Key::UNKNOWN }}</div>

        </div>

        <div class="attribute">

            <div class="name">Leerjaar</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_LEERJAAR} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_LEERJAAR} : \App\Http\Support\Key::UNKNOWN }}</div>

        </div>

        <div class="attribute">

            <div class="name">Profiel</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_PROFILE} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_PROFILE} : \App\Http\Support\Key::UNKNOWN }}</div>

        </div>

    </div>

</div>
