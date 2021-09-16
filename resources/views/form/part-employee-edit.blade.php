<div class="title">{{ __('Educatie huidig') }}</div>

@include('form.field-input', ['id' => 'education_current', 'tag' => 'Niveau', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_CURRENT}])

@include('form.field-input', ['id' => 'school_current', 'tag' => 'Onderwijsinstelling', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_CURRENT}])

@include('form.field-input', ['id' => 'profile_current', 'tag' => 'Opleiding', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_CURRENT}])

<div class="seperator"></div>



<div class="title">{{ __('Educatie middelbare') }}</div>

@include('form.field-input', ['id' => 'education_middelbare', 'tag' => 'Niveau', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_EDUCATION_MIDDELBARE}])

@include('form.field-input', ['id' => 'school_middelbare', 'tag' => 'School', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_SCHOOL_MIDDELBARE}])

@include('form.field-input', ['id' => 'profile_middelbare', 'tag' => 'Profiel', 'icon' => 'search.svg', 'data' => true, 'show_all' => true, 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_MIDDELBARE}])

<div class="seperator"></div>



<div class="title">{{ __('Arbeidgegevens') }}</div>

@include('form.field-input', ['id' => 'motivation', 'tag' => 'Motivatie', 'placeholder' => 'Waarom wil deze persoon bij Studied werken?', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_MOTIVATION}])

@include('form.field-input', ['id' => 'capacity', 'tag' => 'Werkcapaciteit', 'placeholder' => 'Uren per week', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_CAPACITY}])

@include('form.field-input', ['id' => 'iban', 'tag' => 'Rekeningnummer (IBAN)', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_IBAN}])

<div class="seperator"></div>



<div class="title">{{ __('Profielgegevens') }}</div>

@if($employee->getUser->role != \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

    @include('form.field-input', ['id' => 'profile_text', 'tag' => 'Profieltekst', 'value' => $employee->{\App\Http\Support\Model::$EMPLOYEE_PROFILE_TEXT}])

@endif

@include('form.field-input', ['id' => 'social_instagram', 'tag' => 'Instagram', 'placeholder' => 'Alleen gebruikersnaam', 'value' => $employee->getUser->getPerson->{\App\Http\Support\Model::$PERSON_SOCIAL_INSTAGRAM}])

@include('form.field-input', ['id' => 'social_linkedin', 'tag' => 'LinkedIn', 'placeholder' => 'Gehele URL van het profiel', 'value' => $employee->getUser->getPerson->{\App\Http\Support\Model::$PERSON_SOCIAL_LINKEDIN}])

<div class="seperator"></div>



<div class="title">{{ __('Bestanden') }}</div>

@include('form.field-file', ['file' => 'cv', 'tag' => 'CV'])

@include('form.field-file', ['file' => 'diploma', 'tag' => 'Diploma'])

@include('form.field-file', ['file' => 'contract', 'tag' => 'Contract'])

@include('form.field-file', ['file' => 'loonheffing', 'tag' => 'Loonheffing'])

@include('form.field-file', ['file' => 'identificatie', 'tag' => 'Identificatie'])

@include('form.field-file', ['file' => 'indiensttreding', 'tag' => 'Indiensttreding'])

<div class="seperator"></div>
