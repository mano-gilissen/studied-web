@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true])

    @include('form.field-select-time')

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])



    <div class="seperator"></div>



    <div class="title">{{ __('Activiteit') }}</div>

    @if(Auth::user()->role == \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

        @include('form.field-hidden', ['id' => '_host', 'value' => Auth::user()->id])

        @include('form.field-select-agreement', ['host' => Auth::user()->id])

    @else

        @include('form.field-input', ['id' => 'host', 'tag' => 'Student-docent', 'icon' => 'search.svg', 'placeholder' => 'Zoek een medewerker', 'required' => true, 'data' => true, 'show_all' => false, 'reject_other' => true, 'uses_id' => true])

        @include('form.field-select-agreement')

    @endisset




    <div class="seperator"></div>



    <div class="title">{{ __('Activiteit') }}</div>

    @include('form.field-input', ['id' => 'subject', 'tag' => 'Onderwerp', 'icon' => 'search.svg', 'data' => true, 'reject_other' => true, 'additional' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'remark', 'tag' => 'Opmerking', 'required' => true])



@endsection
