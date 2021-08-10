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

                    <div class="value">{{ $person->getUser->getEmployee->school_current ?? \App\Http\Traits\UserTrait::getRoleName($person->getUser, true) }}</div>

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

                <div class="attribute">

                    <div class="name">Leerjaar</div>

                    <div class="value">{{ \App\Http\Traits\UserTrait::getNiveauText($person->getUser->getStudent->niveau) . ' ' . $person->getUser->getStudent->leerjaar }}</div>

                </div>

                <div class="attribute">

                    <div class="name">Profiel</div>

                    <div class="value">{{ $person->getUser->getStudent->profile }}</div>

                </div>

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @break

        @endswitch

        @switch(Auth::user()->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                <div class="attribute">

                    <div class="name">Status</div>

                    <div class="value">

                        <div class="tag" style="background: {{ \App\Http\Support\Color::GREEN }};color: white">Actief</div>

                    </div>

                </div>

                @break

        @endswitch

    </div>

</div>
