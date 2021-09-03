@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true, 'value' => \App\Http\Support\Format::datetime($study->{\App\Http\Support\Model::$STUDY_START}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('form.field-select-time', ['set_study' => true, 'edit' => true])

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => ($current_location ?? false) ? $current_location : -1])

    @include('form.field-input', ['id' => 'link', 'tag' => 'Digitale les', 'icon' => 'url.svg', 'placeholder' => 'Plak een URL', 'value' => $study->{\App\Http\Support\Model::$STUDY_LINK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Gegevens') }}</div>

    @include('form.field-input', ['id' => 'status', 'tag' => 'Status', 'icon' => 'edit.svg', 'placeholder' => 'Kies een status', 'required' => true, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => \App\Http\Traits\StudyTrait::isReported($study), 'set_id' => $study->{\App\Http\Support\Model::$STUDY_STATUS}])

    @include('form.field-input', ['id' => 'remark', 'tag' => 'Opmerking', 'value' => $study->{\App\Http\Support\Model::$STUDY_REMARK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Acties') }}</div>



    @include('form.field-hidden', ['id' => '_study', 'value' => $study->id])



@endsection
