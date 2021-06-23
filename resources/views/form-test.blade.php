@extends('template.form')



@section('fields')

    <div class="title">{{ __('Basis elementen') }}</div>

    @include('form.field-input', ['id' => 'field_text', 'tag' => 'Tekstveld', 'placeholder' => 'Een tekstveld', 'required' => true])

    @include('form.field-input', ['id' => 'field_text_icon', 'tag' => 'Tekstveld icon', 'icon' => 'search.svg', 'placeholder' => 'Een tekstveld met een icon', 'required' => true])

    @include('form.field-select-time')

    <div style="height: 88px;"></div>

    <div class="title">{{ __('Autocomplete') }}</div>

    @include('form.field-input', ['id' => 'field_autocomplete', 'tag' => 'Autocomplete', 'placeholder' => 'Een autocomplete veld (Vak data)', 'data' => true])

    @include('form.field-input', ['id' => 'field_autocomplete_reject', 'tag' => 'Autocomplete Reject', 'placeholder' => 'Een autocomplete veld (Vak data)', 'data' => true, 'reject_other' => true])

    @include('form.field-input', ['id' => 'field_autocomplete_reject_show_all', 'tag' => 'Autocomplete Reject Show All', 'placeholder' => 'Een autocomplete veld (Vak data)', 'data' => true, 'reject_other' => true, 'show_all' => true])

@endsection
