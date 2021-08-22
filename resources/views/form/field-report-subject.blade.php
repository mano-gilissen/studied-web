@php $id_user = 'user_' . $user->id . '_'; @endphp

@php echo($agreement) @endphp



@include('form.field-input', ['id' => $id_user . 'subject_' . $id, 'tag' => 'Activiteit', 'icon' => $primary ? 'fix.svg' : 'search.svg', 'placeholder' => 'Zoek een activiteit', 'required' => true, 'data' => true, 'additional' => true, 'ac_data' => 'subject_' . ($primary ? 'primary' : 'secondary'), 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => $primary, 'set_id' => $primary ? $study->subject_defined : -1])

@include('form.field-select-duration', ['id' => $id_user . 'subject_' . $id . '_duration', 'set_max' => $primary])

@include('form.field-input', ['id' => '_' . $id_user . 'subject_'. $id . '_content_verslag', 'tag' => 'Beschrijf de les', 'required' => true, 'placeholder' => 'Typ het lesverslag', 'locked' => false])



@if (false)

    @include('form.field-hidden', ['id' => $id_user . 'subject_' . $id . '_agreement', 'value' => $agreement->id])

@endif
