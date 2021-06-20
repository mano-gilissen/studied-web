@extends('form')



@section('fields')

    <div class="title">{{ __('Gegevens') }}</div>

    @include('form.field-input', ['id' => 'onderwerp', 'tag' => 'Onderwerp', 'placeholder' => 'Vul een onderwerp in', 'required' => true, 'data' => true])

    @include('form.field-input', ['id' => 'vak', 'tag' => 'Vak', 'icon' => 'search.svg', 'data' => true])

    @include('form.field-select-time')

@endsection
