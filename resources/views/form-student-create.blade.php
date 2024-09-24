@extends('template.form')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('form.field-input', ['id' => 'prefix', 'tag' => __('Titel'), 'placeholder' => __('Selecteer..'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'value' => old('prefix')])

    @include('form.field-input', ['id' => 'first_name', 'tag' => __('Voornaam'), 'required' => true, 'value' => old('first_name')])

    @include('form.field-input', ['id' => 'middle_name', 'tag' => __('Tussenvoegsel'), 'value' => old('middle_name')])

    @include('form.field-input', ['id' => 'last_name', 'tag' => __('Achternaam'), 'required' => true, 'value' => old('last_name')])

    @include('form.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => __('Geboortedatum'), 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => old('birth_date')])

    @include('form.field-input', ['id' => 'language', 'tag' => __('Taal'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'ac_data' => 'language', 'uses_id' => true, 'set_id' => \App\Http\Middleware\Locale::LOCALE_NL])

    @include('form.field-input', ['id' => 'refer', 'tag' => __('Referentie'), 'placeholder' => __('Hoe komt deze persoon bij Studied terecht?'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true,  'value' => old('refer')])

    @include('form.field-input', ['id' => 'branch', 'tag' => __('Bedrijfstak'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'ac_data' => 'branch', 'uses_id' => true, 'set_id' => 1, 'value' => old('branch')])

    <div class="seperator"></div>



    <div class="title">{{ __('Contact- en inloggegevens') }}</div>

    @include('form.field-input', ['id' => 'email', 'type' => 'email', 'tag' => __('Email-adres'), 'required' => true, 'value' => old('email')])

    @include('form.field-input', ['id' => 'phone', 'type' => 'phone', 'tag' => __('Telefoonnummer'), 'placeholder' => __('Telefoonnummer met landcode'), 'value' => old('phone')])

    <div class="seperator"></div>



    <div class="title">{{ __('Woonadres') }}</div>

    @include('form.field-input', ['id' => 'street', 'tag' => __('Straatnaam'), 'required' => true, 'value' => old('street')])

    <div class="field">

        <div class="name">{{ __('Huisnummer') }}</div>

        @include('form.box-input', ['id' => 'number', 'required' => true, 'size' => 'width-third', 'value' => old('number')])

        <div class="note width-third">{{ __('Toevoeging') }}</div>

        @include('form.box-input', ['id' => 'addition', 'size' => 'width-third', 'value' => old('addition')])

    </div>

    @include('form.field-input', ['id' => 'zipcode', 'tag' => __('Postcode'), 'required' => true, 'value' => old('zipcode')])

    @include('form.field-input', ['id' => 'city', 'tag' => __('Stad'), 'required' => true, 'value' => old('city')])

    @include('form.field-input', ['id' => 'country', 'tag' => __('Land'), 'required' => true, 'value' => old('country')])

    <div class="seperator"></div>



    <div class="title">{{ __('Educatie') }}</div>

    @include('form.field-input', ['id' => 'school', 'tag' => __('School'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => old('school')])

    @include('form.field-input', ['id' => 'niveau', 'tag' => __('Niveau'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'leerjaar', 'tag' => __('Leerjaar'), 'data' => true, 'icon' => 'dropdown.svg', 'required' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'profile', 'tag' => __('Profiel'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => old('profile')])

    <div class="seperator"></div>



    <div class="title">{{ __('Relaties') }}</div>

    @include('form.field-input', ['id' => 'customer', 'tag' => __('Klant'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een klant'), 'required' => false, 'data' => true, 'additional' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'name_mentor', 'tag' => __('Naam mentor'), 'value' => old('name_mentor')])

    @include('form.field-input', ['id' => 'email_mentor', 'type' => 'email', 'tag' => __('Email mentor'), 'value' => old('email_mentor')])

    @include('form.field-input', ['id' => 'name_vakdocent_1','tag' => __('Naam vakdocent 1'), 'value' => old('name_vakdocent_1')])

    @include('form.field-input', ['id' => 'email_vakdocent_1', 'type' => 'email', 'tag' => __('Email vakdocent 1'), 'value' => old('email_vakdocent_1')])

    @include('form.field-input', ['id' => 'name_vakdocent_2', 'tag' => __('Naam vakdocent 2'), 'value' => old('name_vakdocent_2')])

    @include('form.field-input', ['id' => 'email_vakdocent_2', 'type' => 'email', 'tag' => __('Email vakdocent 2'), 'value' => old('email_vakdocent_2')])

    @include('form.field-input', ['id' => 'name_vakdocent_3', 'tag' => __('Naam vakdocent 3'), 'value' => old('name_vakdocent_3')])

    @include('form.field-input', ['id' => 'email_vakdocent_3', 'type' => 'email', 'tag' => __('Email vakdocent 3'), 'value' => old('email_vakdocent_3')])

    <div class="seperator"></div>



@endsection
