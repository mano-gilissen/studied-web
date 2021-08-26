@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true])

    @include('form.field-select-time', ['end' => false])

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true, 'uses_id' => true])

    <div class="seperator"></div>



    <div class="title">{{ __('Aanwezigen') }}</div>

    @include('form.field-input', ['id' => 'host', 'tag' => 'Host', 'icon' => 'search.svg', 'placeholder' => 'Zoek een medewerker', 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_1', 'tag' => 'Student-docent #1', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student-docent', 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'employee_2', 'tag' => 'Student-docent #2', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student-docent', 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'student', 'tag' => 'Student', 'icon' => 'search.svg', 'placeholder' => 'Zoek een student', 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $student ? $student->id : -1])



    <div class="title">{{ __('Details') }}</div>

    @include('form.field-input', ['id' => 'regarding', 'tag' => 'Onderwerp', 'required' => true, 'data' => true, 'uses_id' => true, 'show_all' => true, 'reject_other' => true])

    @include('form.field-textarea', ['id' => 'remark', 'tag' => 'Opmerking'])



@endsection
