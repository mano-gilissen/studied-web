<div class="block-attributes">

    <div class="title">Dienstbetrekking</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Capaciteit</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_CAPACITY} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_CAPACITY} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">IBAN</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_IBAN} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_IBAN} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Motivatie</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_MOTIVATION} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_MOTIVATION} : __('Onbekend') }}</div>

        </div>

    </div>

</div>
