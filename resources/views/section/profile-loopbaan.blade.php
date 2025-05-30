<div class="block-attributes">

    <div class="title">{{ __('Loopbaan') }}</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ __('Huidige opleiding') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_CURRENT} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Huidige onderwijsinstelling') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_CURRENT} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Middelbare school niveau') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_MIDDELBARE} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Profiel middelbare school') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_CURRENT} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Middelbare school') }}</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_MIDDELBARE} ?? __('Onbekend') }}</div>

        </div>

    </div>

</div>
