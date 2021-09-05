<div class="title">{{ __('Educatie huidig') }}</div>

@include('form.field-input', ['id' => 'education_current', 'tag' => 'Niveau', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_CURRENT}])

@include('form.field-input', ['id' => 'school_current', 'tag' => 'School', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_CURRENT}])

@include('form.field-input', ['id' => 'profile_current', 'tag' => 'Profiel', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_CURRENT}])

<div class="seperator"></div>



<div class="title">{{ __('Educatie middelbare') }}</div>

@include('form.field-input', ['id' => 'education_middelbare', 'tag' => 'Niveau', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_MIDDELBARE}])

@include('form.field-input', ['id' => 'school_middelbare', 'tag' => 'School', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_MIDDELBARE}])

@include('form.field-input', ['id' => 'profile_middelbare', 'tag' => 'Profiel', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_MIDDELBARE}])

<div class="seperator"></div>



<div class="title">{{ __('Arbeidgegevens') }}</div>

@include('form.field-input', ['id' => 'motivation', 'tag' => 'Motivatie', 'placeholder' => 'Waarom wil deze persoon bij Studied werken?', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_MOTIVATION}])

@include('form.field-input', ['id' => 'refer', 'tag' => 'Referentie', 'placeholder' => 'Hoe komt deze persoon bij Studied terecht?', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_REFER}])

@include('form.field-input', ['id' => 'capacity', 'tag' => 'Werkcapaciteit', 'placeholder' => 'Uren per week', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_CAPACITY}])

@include('form.field-input', ['id' => 'iban', 'tag' => 'Rekeningnummer (IBAN)', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_IBAN}])

<div class="seperator"></div>
