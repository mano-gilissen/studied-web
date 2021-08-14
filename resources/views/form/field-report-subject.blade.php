@include('form.field-input', ['id' => 'subject_' . $id, 'tag' => 'Activiteit', 'icon' => 'close.svg', 'placeholder' => 'Zoek een activiteit', 'required' => true, 'data' => true, 'additional' => true, 'ac_data' => 'subject', 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => $locked, 'set_id' => $set_id])

@include('form.field-select-duration', ['id' => $id, 'available' => $available])

@include('form.field-input', ['id' => 'lesverslag_'. $id, 'tag' => 'Beschrijf de les', 'required' => true, 'placeholder' => 'Typ het lesverslag', 'locked' => false])
