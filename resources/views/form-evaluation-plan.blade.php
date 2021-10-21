@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true, 'value' => old('date')])

    @include('form.field-select-time', ['end' => false])

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true, 'uses_id' => true, 'value' => old('location')])

    @include('form.field-input', ['id' => 'link', 'tag' => 'Digitale meeting', 'icon' => 'url.svg', 'placeholder' => 'Plak een URL', 'value' => old('link')])

    <div class="seperator"></div>



    <div class="title">{{ __('Aanwezigen') }}</div>

    @include('form.field-input', ['id' => 'host', 'tag' => 'Host', 'icon' => 'search.svg', 'placeholder' => 'Zoek een medewerker', 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_1', 'tag' => 'Student-docent #1', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student-docent', 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_2', 'tag' => 'Student-docent #2', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student-docent', 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_3', 'tag' => 'Student-docent #3', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student-docent', 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'student', 'tag' => 'Leerling', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student', 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student ?? -1])

    <div class="seperator"></div>



    <div class="title">{{ __('Details') }}</div>

    @include('form.field-input', ['id' => 'regarding', 'tag' => 'Onderwerp', 'required' => true, 'data' => true, 'uses_id' => true, 'show_all' => true, 'reject_other' => true])

    @include('form.field-textarea', ['id' => 'remark', 'tag' => 'Opmerking'])



@endsection
