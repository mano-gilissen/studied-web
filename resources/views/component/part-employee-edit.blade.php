<div class="title">{{ __('Educatie huidig') }}</div>

@include('component.field-input', ['id' => 'education_current', 'tag' => __('Leerjaar'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_CURRENT}])

@include('component.field-input', ['id' => 'school_current', 'tag' => __('Onderwijsinstelling'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_CURRENT}])

@include('component.field-input', ['id' => 'profile_current', 'tag' => __('Opleiding'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_CURRENT}])

<div class="seperator"></div>



<div class="title">{{ __('Educatie middelbare') }}</div>

@include('component.field-input', ['id' => 'education_middelbare', 'tag' => __('Niveau'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_MIDDELBARE}])

@include('component.field-input', ['id' => 'school_middelbare', 'tag' => __('School'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_MIDDELBARE}])

@include('component.field-input', ['id' => 'profile_middelbare', 'tag' => __('Profiel'), 'icon' => 'search.svg', 'data' => true, 'show_all' => true, 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_MIDDELBARE}])

<div class="seperator"></div>



<div class="title">{{ __('Arbeidgegevens') }}</div>

@include('component.field-input', ['id' => 'motivation', 'tag' => __('Motivatie'), 'placeholder' => __('Waarom wil deze persoon bij Studied werken?'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_MOTIVATION}])

@include('component.field-input', ['id' => 'capacity', 'tag' => __('Werkcapaciteit'), 'placeholder' => __('Uren per week'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_CAPACITY}])

@include('component.field-input', ['id' => 'iban', 'tag' => __('Rekeningnummer (IBAN)'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_IBAN}])

<div class="seperator"></div>



<div class="title">{{ __('Profielgegevens') }}</div>

@if($employee->getUser->role != \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

    @include('component.field-input', ['id' => 'profile_text', 'tag' => __('Profieltekst'), 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_TEXT}])

@endif

@include('component.field-input', ['id' => 'social_instagram', 'tag' => __('Instagram'), 'placeholder' => __('Alleen gebruikersnaam'), 'value' => $employee->getUser->getPerson->{\App\Http\Support\Model::$PERSON_SOCIAL_INSTAGRAM}])

@include('component.field-input', ['id' => 'social_linkedin', 'tag' => __('LinkedIn'), 'placeholder' => __('Gehele URL van het profiel'), 'value' => $employee->getUser->getPerson->{\App\Http\Support\Model::$PERSON_SOCIAL_LINKEDIN}])

<div class="seperator"></div>



<div class="title">{{ __('Bestanden') }}</div>

@include('component.field-file', ['file' => 'cv', 'tag' => __('CV')])

@include('component.field-file', ['file' => 'diploma', 'tag' => __('Diploma')])

@include('component.field-file', ['file' => 'contract', 'tag' => __('Contract')])

@include('component.field-file', ['file' => 'loonheffing', 'tag' => __('Loonheffing')])

@include('component.field-file', ['file' => 'identificatie', 'tag' => __('Identificatie')])

@include('component.field-file', ['file' => 'indiensttreding', 'tag' => __('Indiensttreding')])

<div class="seperator"></div>
