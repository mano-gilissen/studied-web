@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => __('Datum'), 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => old('date')])

    @include('form.field-select-time', ['end' => false])

    @include('form.field-input', ['id' => 'location', 'tag' => __('Locatie'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een locatie'), 'required' => true, 'data' => true, 'show_all' => true, 'uses_id' => true, 'value' => old('location')])

    @include('form.field-input', ['id' => 'link', 'tag' => __('Digitale meeting'), 'icon' => 'url.svg', 'placeholder' => __('Plak een URL'), 'value' => old('link')])

    <div class="seperator"></div>



    <div class="title">{{ __('Aanwezigen') }}</div>

    @include('form.field-input', ['id' => 'host', 'tag' => __('Host'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een medewerker'), 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_1', 'tag' => __('Student-docent #1'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een student-docent'), 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_2', 'tag' => __('Student-docent #2'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een student-docent'), 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_3', 'tag' => __('Student-docent #3'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een student-docent'), 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'student', 'tag' => __('Leerling'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een student'), 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student ?? -1])

    <div class="seperator"></div>



    <div class="title">{{ __('Details') }}</div>

    @include('form.field-input', ['id' => 'regarding', 'tag' => __('Onderwerp'), 'required' => true, 'data' => true, 'uses_id' => true, 'show_all' => true, 'reject_other' => true])

    @include('form.field-textarea', ['id' => 'remark', 'tag' => __('Opmerking'), 'value' => old('remark')])



@endsection
