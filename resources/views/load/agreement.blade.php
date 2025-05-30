<div style="display: flex;align-items: center">

    @if($single ?? false)

        <div class="title">{{ __('Vakafspraak') }}</div>

    @else

        <div class="title">{{ __('Vakafspraak') . ' #' . $id }}</div>

        <img class="remove" src="/images_app/close-black.svg" onclick="$(this).parent().parent().remove()">

    @endif

</div>

@include('component.field-input', ['id' => 'student_' . $id, 'tag' => __('Leerling'), 'icon' => 'fix.svg', 'required' => true, 'data' => true, 'additional' => true, 'ac_data' => 'student', 'uses_id' => true, 'locked' => true, 'set_id' => $student, 'value' => old('student_' . $id)])

@include('component.field-input', ['id' => 'employee_' . $id, 'tag' => __('Student-docent'), 'icon' => 'search.svg', 'required' => true, 'data' => true, 'additional' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'employee', 'uses_id' => true, 'value' => old('employee_' . $id)])

@include('component.field-input', ['id' => 'service_' . $id, 'tag' => __('Dienst'), 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'service', 'uses_id' => true, 'value' => old('service_' . $id)])

@include('component.field-input', ['id' => 'plan_' . $id, 'tag' => __('Begeleidingsvorm'), 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'plan', 'uses_id' => true, 'value' => old('plan_' . $id)])

<div class="field">

    <div class="name">{{ __('Vak') }}</div>

    @include('component.box-input', ['id' => 'subject_' . $id, 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'subject', 'uses_id' => true, 'size' => 'width-third', 'value' => old('subject_' . $id)])

    <div class="note width-third">{{ __('Niveau') }}</div>

    @include('component.box-input', ['id' => 'level_' . $id, 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'level', 'uses_id' => true, 'size' => 'width-third', 'value' => old('level_' . $id)])

</div>

@include('component.field-input', ['id' => 'hours_' . $id, 'type' => 'number', 'tag' => __('Uren per week'), 'required' => true, 'value' => old('hours_' . $id, 1)])

@include('component.field-input', ['id' => 'start_' . $id, 'type' => 'date', 'tag' => __('Geldig vanaf'), 'required' => true, 'value' => old('start_' . $id)])

@include('component.field-input', ['id' => 'end_' . $id, 'type' => 'date', 'tag' => __('Geldig tot'), 'required' => true, 'value' => old('end_' . $id)])

@include('component.field-input', ['id' => 'preference_group_' . $id, 'tag' => __('Voorkeur groepsles of individueel'), 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'show_always' => true, 'ac_data' => 'preference_group', 'uses_id' => true, 'set_id' => old('preference_group_' . $id) ?? 1])

@include('component.field-input', ['id' => 'preference_location_' . $id, 'tag' => __('Voorkeur locatie fysiek of digitaal'), 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'show_always' => true, 'ac_data' => 'preference_location', 'uses_id' => true, 'set_id' => old('preference_location_' . $id) ?? 1])

@include('component.field-textarea', ['id' => 'remark_' . $id, 'tag' => __('Opmerkingen'), 'value' => old('remark_' . $id)])

@include('component.field-input', ['id' => 'replace_' . $id, 'tag' => __('Vervangt (optioneel)'), 'icon' => 'search.svg', 'show_all' => true, 'data' => true, 'additional' => true, 'reject_other' => true, 'ac_data' => 'replace', 'uses_id' => true, 'placeholder' => __('Welke vakafspraak wordt vervangen?'), 'trigger' => 'agreement_extend', 'identifier' => $id, 'value' => old('replace_' . $id)])

@include('component.switch', ['id' => 'trial_' . $id, 'tag' => __('Proefles'), 'default' => 2, 'value' => old('trial_' . $id)])

<div class="seperator large"></div>
