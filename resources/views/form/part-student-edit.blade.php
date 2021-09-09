<div class="title">{{ __('Educatie') }}</div>

@include('form.field-input', ['id' => 'school', 'tag' => 'School', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $student->{\App\Http\Support\Model::$STUDENT_SCHOOL}])

@include('form.field-input', ['id' => 'niveau', 'tag' => 'Niveau', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$STUDENT_NIVEAU}])

@include('form.field-input', ['id' => 'leerjaar', 'tag' => 'Leerjaar', 'data' => true, 'icon' => 'dropdown.svg', 'required' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$STUDENT_LEERJAAR}])

@include('form.field-input', ['id' => 'profile', 'tag' => 'Profiel', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $student->{\App\Http\Support\Model::$STUDENT_PROFILE}])

<div class="seperator"></div>



<div class="title">{{ __('Relaties') }}</div>

@include('form.field-input', ['id' => 'customer', 'tag' => 'Klant', 'icon' => 'search.svg', 'placeholder' => 'Zoek een klant', 'required' => false, 'data' => true, 'additional' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$CUSTOMER}])

@include('form.field-input', ['id' => 'email_mentor', 'type' => 'email', 'tag' => 'Email mentor', 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_MENTOR}])

@include('form.field-input', ['id' => 'email_vakdocent_1', 'type' => 'email', 'tag' => 'Email vakdocent 1', 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_1}])

@include('form.field-input', ['id' => 'email_vakdocent_2', 'type' => 'email', 'tag' => 'Email vakdocent 2', 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_2}])

@include('form.field-input', ['id' => 'email_vakdocent_3', 'type' => 'email', 'tag' => 'Email vakdocent 3', 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_3}])

<div class="seperator"></div>
