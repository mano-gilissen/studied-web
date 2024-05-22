<div class="block-attributes">

    <div class="title">Onderwijs</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">School</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_SCHOOL} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_SCHOOL} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Niveau</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NIVEAU} ? \App\Http\Traits\StudentTrait::getNiveauText($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NIVEAU}) : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Leerjaar</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_LEERJAAR} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_LEERJAAR} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Profiel</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_PROFILE} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_PROFILE} : __('Onbekend') }}</div>

        </div>

    </div>

</div>
