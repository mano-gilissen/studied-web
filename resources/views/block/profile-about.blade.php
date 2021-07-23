<div class="block-attributes">

    <div class="title">Over {{ $person->first_name }}</div>

    <div class="list-attributes">

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                <div class="attribute">

                    <div class="name">{{ $person->getUser->getEmployee->school_current ? 'School' : 'Functie'}}</div>

                    <div class="value">{{ $person->getUser->getEmployee->school_current ? $person->getUser->getEmployee->school_current : ($person->getUser->getEmployee->occupation ? $person->getUser->getEmployee->occupation : \App\Http\Support\Key::UNKNOWN)}}</div>

                </div>

                <div class="attribute">

                    <div class="name">Opleiding</div>

                    <div class="value">{{ $person->getUser->getEmployee->profile_current ? $person->getUser->getEmployee->profile_current : \App\Http\Support\Key::UNKNOWN}}</div>

                </div>

                <div class="attribute">

                    <div class="name">Werkzaam</div>

                    <div class="value">{{ 'Sinds ' . \App\Http\Support\Format::datetime($person->getUser->getEmployee->start_employment, \App\Http\Support\Format::$DATETIME_PROFILE) }}</div>

                </div>

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                <div class="attribute">

                    <div class="name">School</div>

                    <div class="value">{{ $person->getUser->getStudent->school }}</div>

                </div>

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @break

        @endswitch

    </div>

</div>
