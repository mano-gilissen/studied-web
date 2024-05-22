<div class="block-attributes">

    <div class="title">Loopbaan</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Huidige opleiding</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_CURRENT} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_CURRENT} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Huidige onderwijsinstelling</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_CURRENT} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_CURRENT} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Middelbare school niveau</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_MIDDELBARE} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_MIDDELBARE} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Profiel middelbare school</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_CURRENT} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_CURRENT} : __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">Middelbare school</div>

            <div class="value">{{ $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_MIDDELBARE} ? $person->getUser->getEmployee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_MIDDELBARE} : __('Onbekend') }}</div>

        </div>

    </div>

</div>
