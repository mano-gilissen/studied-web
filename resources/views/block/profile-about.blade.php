<div class="block-attributes">

    <div class="title">Over {{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }}</div>

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

                <div class="value">{{ Format::datetime($person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE}, \App\Http\Support\Format::$DATETIME_PROFILE) }}</div>

            </div>

        @endif

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                <div class="attribute">

                    <div class="name">Werkzaam</div>

                    <div class="value">{{ $person->getUser->getEmployee->start_employment ? ('Sinds ' . \App\Http\Support\Format::datetime($person->getUser->getEmployee->start_employment, \App\Http\Support\Format::$DATETIME_PROFILE)) : \App\Http\Support\Key::UNKNOWN }}</div>

                </div>

                @break

        @endswitch

        @if(\App\Http\Traits\BaseTrait::hasManagementRights())

            <div class="attribute">

                <div class="name">Referentie</div>

                <div class="value">{{ $person->{\App\Http\Support\Model::$PERSON_REFER} ? $person->{\App\Http\Support\Model::$PERSON_REFER} : \App\Http\Support\Key::UNKNOWN }}</div>

            </div>

            <div class="attribute">

                <div class="name">Status</div>

                <div class="value">

                    @php $status = $person->getUser->{\App\Http\Support\Model::$USER_STATUS} @endphp

                    <div class="tag" style="background: {{ \App\Http\Traits\UserTrait::getStatusColor($status) }};color: {{ \App\Http\Traits\UserTrait::getStatusTextColor($status) }}">{{ \App\Http\Traits\UserTrait::getStatusText($status) }}</div>

                </div>

            </div>

        @endif

    </div>

</div>
