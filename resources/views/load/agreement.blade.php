<div style="display: flex;align-items: center">

    @if($single ?? false)

        <div class="title">{{ __('Vakafspraak') }}</div>

    @else

        <div class="title">{{ __('Vakafspraak #' . $id) }}</div>

        <img class="remove" src="/images_app/close-black.svg" onclick="$(this).parent().parent().remove()">

    @endif


</div>

@include('form.field-input', ['id' => 'student_' . $id, 'tag' => 'Leerling', 'icon' => 'fix.svg', 'required' => true, 'data' => true, 'additional' => true, 'ac_data' => 'student', 'uses_id' => true, 'locked' => true, 'set_id' => $student])

@include('form.field-input', ['id' => 'employee_' . $id, 'tag' => 'Student-docent', 'icon' => 'search.svg', 'required' => true, 'data' => true, 'additional' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'employee', 'uses_id' => true])

<div class="field">

    <div class="name">Vak</div>

    @include('form.box-input', ['id' => 'subject_' . $id, 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'subject', 'uses_id' => true, 'size' => 'width-third'])

    <div class="note width-third">Niveau</div>

    @include('form.box-input', ['id' => 'level_' . $id, 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'level', 'uses_id' => true, 'size' => 'width-third'])

</div>

<div class="field">

    <div class="name">Min</div>

    @include('form.box-input', ['id' => 'min_' . $id, 'required' => true, 'size' => 'width-third'])

    <div class="note width-third">Max</div>

    @include('form.box-input', ['id' => 'max_' . $id, 'required' => true, 'size' => 'width-third'])

</div>

@include('form.field-input', ['id' => 'start_' . $id, 'type' => 'date', 'tag' => 'Geldig vanaf', 'required' => true])

@include('form.field-input', ['id' => 'end_' . $id, 'type' => 'date', 'tag' => 'Geldig tot', 'required' => true])

@include('form.field-textarea', ['id' => 'remark_' . $id, 'tag' => 'Opmerkingen'])

@include('form.field-input', ['id' => 'replace_' . $id, 'tag' => 'Vervangt (optioneel)', 'icon' => 'search.svg', 'show_all' => true, 'data' => true, 'additional' => true, 'reject_other' => true, 'ac_data' => 'replace', 'uses_id' => true, 'placeholder' => 'Welke vakafspraak wordt vervangen?'])

<div class="seperator large"></div>
