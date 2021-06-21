@extends('form')



@section('fields')

    <div class="title">{{ __('Gegevens') }}</div>

    @include('form.field-input', ['id' => 'field_text', 'tag' => 'Tekstveld', 'placeholder' => 'Een tekstveld', 'required' => true])

    @include('form.field-input', ['id' => 'field_text_icon', 'tag' => 'Tekstveld icon', 'icon' => 'search.svg', 'placeholder' => 'Een tekstveld met een icon', 'required' => true])

    @include('form.field-input', ['id' => 'field_autocomplete_reject_show_all', 'tag' => 'Autocomplete Reject Show All', 'placeholder' => 'Een autocomplete veld (Vak data)', 'data' => true, 'reject_other' => true, 'show_all' => true])

    @include('form.field-select-time')

@endsection
