<div class="block-attributes">

    <div class="title">Mentoren en vakdocenten</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Mentor</div>

            <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_MENTOR} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_MENTOR} : __('Onbekend') }}</div>

        </div>

        @if($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_1})

            <div class="attribute">

                <div class="name">Vakdocent 1 Naam</div>

                <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_1} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_1} : __('Onbekend') }}</div>

            </div>

        @endif

        @if($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_1})

            <div class="attribute">

                <div class="name">Vakdocent 1 Email</div>

                <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_1} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_1} : __('Onbekend') }}</div>

            </div>

        @endif

        @if($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_2})

            <div class="attribute">

                <div class="name">Vakdocent 2 Naam</div>

                <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_2} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_2} : __('Onbekend') }}</div>

            </div>

        @endif

        @if($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_2})

            <div class="attribute">

                <div class="name">Vakdocent 2 Email</div>

                <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_2} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_2} : __('Onbekend') }}</div>

            </div>

        @endif

        @if($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_3})

            <div class="attribute">

                <div class="name">Vakdocent 3 Naam</div>

                <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_3} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_3} : __('Onbekend') }}</div>

            </div>

        @endif

        @if($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_3})

            <div class="attribute">

                <div class="name">Vakdocent 3 Email</div>

                <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_3} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_3} : __('Onbekend') }}</div>

            </div>

        @endif

    </div>

</div>
