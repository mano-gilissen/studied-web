@extends('template.form')



@section('fields')

    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true])

    @include('form.field-select-time')

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true])

    <div style="height: 88px;"></div>

    <div class="title">{{ __('Activiteit') }}</div>

    @include('form.field-input', ['id' => 'subject', 'tag' => 'Onderwerp', 'data' => true, 'reject_other' => true])

    @include('form.field-input', ['id' => 'remark', 'tag' => 'Opmerking', 'required' => true])

@endsection
