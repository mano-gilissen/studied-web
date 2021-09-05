<div class="title">{{ __('Educatie') }}</div>

@include('form.field-input', ['id' => 'school', 'tag' => 'School', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $student->{\App\Http\Support\Model::$STUDENT_SCHOOL}])

@include('form.field-input', ['id' => 'niveau', 'tag' => 'Niveau', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$STUDENT_NIVEAU}])

@include('form.field-input', ['id' => 'leerjaar', 'tag' => 'Leerjaar', 'data' => true, 'icon' => 'dropdown.svg', 'required' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$STUDENT_LEERJAAR}])

@include('form.field-input', ['id' => 'profile', 'tag' => 'Profiel', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $student->{\App\Http\Support\Model::$STUDENT_PROFILE}])

<div class="seperator"></div>



<div class="title">{{ __('Ouder verzorger') }}</div>

@include('form.field-input', ['id' => 'customer', 'tag' => 'Klant', 'icon' => 'search.svg', 'placeholder' => 'Zoek een klant', 'required' => false, 'data' => true, 'additional' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student->{\App\Http\Support\Model::$CUSTOMER}])

<div class="seperator"></div>
