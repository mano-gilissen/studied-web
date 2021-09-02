@extends('template.form')



@section('fields')


    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true, 'value' => \App\Http\Support\Format::datetime($study->{\App\Http\Support\Model::$STUDY_START}, \App\Http\Support\Format::$DATABASE_DATE)])

    @include('form.field-select-time', ['set_study' => $study, 'edit' => true])

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => -1])

    @include('form.field-input', ['id' => 'link', 'tag' => 'Digitale les', 'icon' => 'url.svg', 'placeholder' => 'Plak een URL', 'value' => $study->{\App\Http\Support\Model::$STUDY_LINK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Details') }}</div>

    @include('form.field-input', ['id' => 'remark', 'tag' => 'Opmerking', 'value' => $study->{\App\Http\Support\Model::$STUDY_REMARK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Acties') }}</div>



@endsection
