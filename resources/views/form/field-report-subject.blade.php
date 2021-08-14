@include('form.field-input', ['id' => 'subject_' . $id, 'tag' => 'Activiteit', 'icon' => $primary ? 'fix.svg' : 'close.svg', 'placeholder' => 'Zoek een activiteit', 'required' => true, 'data' => true, 'additional' => true, 'ac_data' => 'subject_primary', 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => $primary, 'set_id' => $primary ? $study->subject_defined : -1])

@include('form.field-select-duration', ['id' => $id, 'set_max' => $primary])

@include('form.field-input', ['id' => 'lesverslag_'. $id, 'tag' => 'Beschrijf de les', 'required' => true, 'placeholder' => 'Typ het lesverslag', 'ac_data' => 'subject_secondary', 'locked' => false])
