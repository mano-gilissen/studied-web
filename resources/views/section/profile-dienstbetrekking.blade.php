<div class="block-attributes">

    <div class="title">{{ __('Dienstbetrekking') }}</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ __('Capaciteit') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_CAPACITY} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('IBAN') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_IBAN} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Motivatie') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_MOTIVATION} ?? __('Onbekend') }}</div>

        </div>

        @if($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

            <div class="attribute">

                <div class="name">{{ __('Achterstand urenplanning') }}</div>

                <div class="value">{{ \App\Http\Traits\EmployeeTrait::calculate_deficit($person->getUser->getEmployee) }}</div>

            </div>

        @endif

    </div>

</div>
