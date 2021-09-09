<div class="block-attributes">

    <div class="title">Contact en persoonlijk</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Email</div>

            <div class="value">{{ $person->getUser->{\App\Http\Support\Model::$USER_EMAIL} ? $person->getUser->{\App\Http\Support\Model::$USER_EMAIL} : \App\Http\Support\Key::UNKNOWN }}</div>

        </div>

        <div class="attribute">

            <div class="name">Telefoon</div>

            <div class="value">{{ $person->{\App\Http\Support\Model::$PERSON_PHONE} ? $person->{\App\Http\Support\Model::$PERSON_PHONE} : \App\Http\Support\Key::UNKNOWN }}</div>

        </div>

        @if(!(($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_BOARD) && (Auth::user()->role == \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)))

            <div class="attribute">

                <div class="name">Adres</div>

                <div class="value">{{ \App\Http\Traits\AddressTrait::getFormatted($person->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) }}</div>

            </div>

            <div class="attribute">

                <div class="name">Geboortedatum</div>

                <div class="value">{{ \App\Http\Support\Format::datetime($person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE}, \App\Http\Support\Format::$DATETIME_PROFILE) }}</div>

            </div>

        @endif

        @if(\App\Http\Traits\BaseTrait::hasManagementRights())

            <div class="attribute">

                <div class="name">Referentie</div>

                <div class="value">{{ $person->{\App\Http\Support\Model::$PERSON_REFER} ? $person->{\App\Http\Support\Model::$PERSON_REFER} : \App\Http\Support\Key::UNKNOWN }}</div>

            </div>

        @endif

    </div>

</div>
