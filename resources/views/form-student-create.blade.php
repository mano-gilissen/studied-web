@extends('template.form')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('form.field-input', ['id' => 'prefix', 'tag' => 'Titel', 'placeholder' => 'Selecteer..', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'value' => old('prefix')])

    @include('form.field-input', ['id' => 'first_name', 'tag' => 'Voornaam', 'required' => true, 'value' => old('first_name')])

    @include('form.field-input', ['id' => 'middle_name', 'tag' => 'Tussenvoegsel', 'value' => old('middle_name')])

    @include('form.field-input', ['id' => 'last_name', 'tag' => 'Achternaam', 'required' => true, 'value' => old('last_name')])

    @include('form.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => 'Geboortedatum', 'placeholder' => 'Kies een datum', 'required' => true, 'value' => old('birth_date')])

    @include('form.field-input', ['id' => 'refer', 'tag' => 'Referentie', 'placeholder' => 'Hoe komt deze persoon bij Studied terecht?', 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'value' => old('refer')])

    <div class="seperator"></div>



    <div class="title">{{ __('Contact- en inloggegevens') }}</div>

    @include('form.field-input', ['id' => 'email', 'type' => 'email', 'tag' => 'Email adres', 'required' => true])

    @include('form.field-input', ['id' => 'phone', 'type' => 'phone', 'tag' => 'Telefoonnummer', 'placeholder' => 'Telefoonnummer met landcode'])

    <div class="seperator"></div>



    <div class="title">{{ __('Woonadres') }}</div>

    @include('form.field-input', ['id' => 'street', 'tag' => 'Straatnaam', 'required' => true])

    <div class="field">

        <div class="name">Huisnummer</div>

        @include('form.box-input', ['id' => 'number', 'required' => true, 'size' => 'width-third'])

        <div class="note width-third">Toevoeging</div>

        @include('form.box-input', ['id' => 'addition', 'size' => 'width-third'])

    </div>

    @include('form.field-input', ['id' => 'zipcode', 'tag' => 'Postcode', 'required' => true])

    @include('form.field-input', ['id' => 'city', 'tag' => 'Stad', 'required' => true])

    @include('form.field-input', ['id' => 'country', 'tag' => 'Land', 'required' => true])

    <div class="seperator"></div>



    <div class="title">{{ __('Educatie') }}</div>

    @include('form.field-input', ['id' => 'school', 'tag' => 'School', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true])

    @include('form.field-input', ['id' => 'niveau', 'tag' => 'Niveau', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'leerjaar', 'tag' => 'Leerjaar', 'data' => true, 'icon' => 'dropdown.svg', 'required' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'profile', 'tag' => 'Profiel', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true])

    <div class="seperator"></div>



    <div class="title">{{ __('Relaties') }}</div>

    @include('form.field-input', ['id' => 'customer', 'tag' => 'Klant', 'icon' => 'search.svg', 'placeholder' => 'Zoek een klant', 'required' => false, 'data' => true, 'additional' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'name_mentor', 'tag' => 'Naam mentor'])

    @include('form.field-input', ['id' => 'email_mentor', 'type' => 'email', 'tag' => 'Email mentor'])

    @include('form.field-input', ['id' => 'naam_vakdocent_1','tag' => 'Naam vakdocent 1'])

    @include('form.field-input', ['id' => 'email_vakdocent_1', 'type' => 'email', 'tag' => 'Email vakdocent 1'])

    @include('form.field-input', ['id' => 'naam_vakdocent_2', 'tag' => 'Naam vakdocent 2'])

    @include('form.field-input', ['id' => 'email_vakdocent_2', 'type' => 'email', 'tag' => 'Email vakdocent 2'])

    @include('form.field-input', ['id' => 'naam_vakdocent_3', 'tag' => 'Naam vakdocent 3'])

    @include('form.field-input', ['id' => 'email_vakdocent_3', 'type' => 'email', 'tag' => 'Email vakdocent 3'])

    <div class="seperator"></div>



@endsection
