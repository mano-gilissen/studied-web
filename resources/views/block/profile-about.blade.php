<div class="block-attributes">

    <div class="title">{{ __('Over') . ' ' . $person->first_name }}</div>

    <div class="list-attributes">

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                <div class="attribute">

                    <div class="name">{{ $person->getUser->getEmployee->school_current ? __('School') : __('Functie')}}</div>

                    <div class="value">{{ $person->getUser->getEmployee->school_current ?? \App\Http\Traits\UserTrait::getRoleName($person->getUser, true) }}</div>

                </div>

                <div class="attribute">

                    <div class="name">{{ __('Opleiding') }}</div>

                    <div class="value">{{ $person->getUser->getEmployee->profile_current ? $person->getUser->getEmployee->profile_current : __('Onbekend')}}</div>

                </div>

                <div class="attribute">

                    <div class="name">{{ __('Werkzaam') }}</div>

                    <div class="value">{{ $person->getUser->getEmployee->start_employment ? (__('Sinds ') . \App\Http\Support\Format::datetime($person->getUser->getEmployee->start_employment, \App\Http\Support\Format::$DATETIME_PROFILE)) : __('Onbekend') }}</div>

                </div>

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @php $customer = $person->getUser->getStudent->getCustomer; @endphp

                @if(!$customer || $customer->getUser->{\App\Http\Support\Model::$USER_CATEGORY} != \App\Http\Traits\RoleTrait::$CATEGORY_CUSTOMER_COMPANY)

                    @break;

                @endif

                <div class="attribute">

                    <div class="name">{{ __('School') }}</div>

                    <div class="value">{{ $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_SCHOOL} ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_SCHOOL} : __('Onbekend')}}</div>

                </div>

                <div class="attribute">

                    <div class="name">{{ __('Leerjaar') }}</div>

                    <div class="value">{{ \App\Http\Traits\StudentTrait::getNiveauText($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_NIVEAU}) . ' ' . __($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_LEERJAAR}) }}</div>

                </div>

                <div class="attribute">

                    <div class="name">{{ __('Profiel') }}</div>

                    <div class="value">{{ __(strlen($person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_PROFILE}) > 0 ? $person->getUser->getStudent->{\App\Http\Support\Model::$STUDENT_PROFILE} : 'Onbekend') }}</div>

                </div>

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @if(\App\Http\Traits\UserTrait::isActivated($person->getUser))

                    <div class="attribute">

                        <div class="name">{{ __('Klant sinds') }}</div>

                        <div class="value">{{ \App\Http\Support\Format::datetime($person->getUser->{\App\Http\Support\Model::$USER_ACTIVATED}, \App\Http\Support\Format::$DATETIME_PROFILE) }}</div>

                    </div>

                @endif

                @break

        @endswitch

        <div class="attribute">

            <div class="name">{{ __('Status') }}</div>

            <div class="value">

                @php $status = $person->getUser->{\App\Http\Support\Model::$USER_STATUS} @endphp

                <div class="tag" style="background: {{ \App\Http\Traits\UserTrait::getStatusColor($status) }};color: {{ \App\Http\Traits\UserTrait::getStatusTextColor($status) }}">{{ \App\Http\Traits\UserTrait::getStatusText($status) }}</div>

            </div>

        </div>

        @if($person->getUser->{\App\Http\Support\Model::$USER_POINTS} > 0)

            <div class="attribute">

                <div class="name">{{ __('Gele punten') }}</div>

                <div class="value">

                    <div class="value">{{ $person->getUser->{\App\Http\Support\Model::$USER_POINTS} }}</div>

                </div>

            </div>

        @endif

    </div>

</div>
