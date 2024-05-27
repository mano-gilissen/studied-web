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

    </div>

</div>
