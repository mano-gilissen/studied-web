@php
    $id_user            = 'user_' . $user->id . '_';
    $report_subject     = $report ? \App\Http\Traits\ReportTrait::getReportSubject($report, $primary) : null;
@endphp



@include('form.field-input', ['id' => $id_user . 'subject_' . $id, 'tag' => 'Activiteit', 'icon' => $primary ? 'fix.svg' : 'search.svg', 'placeholder' => __('Zoek een activiteit'), 'required' => true, 'data' => true, 'additional' => true, 'ac_data' => 'subject_' . ($primary ? 'primary' : 'secondary'), 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => $primary, 'set_id' => $report_subject ? $report_subject->subject : ($primary ? $agreement->subject : -1)])

@include('form.field-select-duration', ['id' => $id_user . 'subject_' . $id . '_duration', 'set_max' => !$report_subject && $primary, 'set' => $report_subject ? $report_subject->{\App\Http\Support\Model::$REPORT_SUBJECT_DURATION} : false])

@include('form.field-textarea', ['id' => '_' . $id_user . 'subject_'. $id . '_content_verslag', 'tag' => 'Beschrijf de les', 'required' => true, 'placeholder' => __('Typ het lesverslag'), 'locked' => false, 'value' => $report_subject ? $report_subject->{\App\Http\Support\Model::$REPORT_SUBJECT_VERSLAG} : old('_' . $id_user . 'subject_'. $id . '_content_verslag')])



@if ($primary)

    @include('form.field-hidden', ['id' => '_' . $id_user . 'subject_' . $id . '_agreement', 'value' => $agreement->id])

@endif
