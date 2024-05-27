<div class="title">{{ __('Educatie') }}</div>

@include('form.field-input', ['id' => 'school', 'tag' => __('School'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $student->{\App\Http\Support\Model::$STUDENT_SCHOOL}])

@include('form.field-input', ['id' => 'niveau', 'tag' => __('Niveau'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$STUDENT_NIVEAU}])

@include('form.field-input', ['id' => 'leerjaar', 'tag' => __('Leerjaar'), 'data' => true, 'icon' => 'dropdown.svg', 'required' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$STUDENT_LEERJAAR}])

@include('form.field-input', ['id' => 'profile', 'tag' => __('Profiel'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $student->{\App\Http\Support\Model::$STUDENT_PROFILE}])

<div class="seperator"></div>



<div class="title">{{ __('Relaties') }}</div>

@include('form.field-input', ['id' => 'customer', 'tag' => __('Klant'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een klant'), 'required' => false, 'data' => true, 'additional' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$CUSTOMER}])

@include('form.field-input', ['id' => 'name_mentor', 'tag' => __('Naam mentor'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_NAME_MENTOR}])

@include('form.field-input', ['id' => 'email_mentor', 'type' => 'email', 'tag' => __('Email mentor'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_MENTOR}])

@include('form.field-input', ['id' => 'name_vakdocent_1', 'tag' => __('Naam vakdocent 1'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_1}])

@include('form.field-input', ['id' => 'email_vakdocent_1', 'type' => 'email', 'tag' => __('Email vakdocent 1'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_1}])

@include('form.field-input', ['id' => 'name_vakdocent_2', 'tag' => __('Naam vakdocent 2'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_2}])

@include('form.field-input', ['id' => 'email_vakdocent_2', 'type' => 'email', 'tag' => __('Email vakdocent 2'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_2}])

@include('form.field-input', ['id' => 'name_vakdocent_3', 'tag' => __('Naam vakdocent 3'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_NAME_VAKDOCENT_3}])

@include('form.field-input', ['id' => 'email_vakdocent_3', 'type' => 'email', 'tag' => __('Email vakdocent 3'), 'value' => $student->{\App\Http\Support\Model::$STUDENT_EMAIL_VAKDOCENT_3}])

<div class="seperator"></div>
