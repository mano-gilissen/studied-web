@extends('template.form')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('form.field-input', ['id' => 'prefix', 'tag' => __('Titel'), 'placeholder' => __('Selecteer..'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'value' => old('prefix')])

    @include('form.field-input', ['id' => 'first_name', 'tag' => __('Voornaam'), 'required' => true, 'value' => old('first_name')])

    @include('form.field-input', ['id' => 'middle_name', 'tag' => __('Tussenvoegsel'), 'value' => old('middle_name')])

    @include('form.field-input', ['id' => 'last_name', 'tag' => __('Achternaam'), 'required' => true, 'value' => old('last_name')])

    @include('form.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => __('Geboortedatum'), 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => old('birth_date')])

    @include('form.field-input', ['id' => 'refer', 'tag' => __('Referentie'), 'placeholder' => __('Hoe komt deze persoon bij Studied terecht?'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'value' => old('refer')])

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



    <div class="title">{{ __('Educatie huidig') }}</div>

    @include('form.field-input', ['id' => 'education_current', 'tag' => __('Leerjaar'), 'value' => old('education_current')])

    @include('form.field-input', ['id' => 'school_current', 'tag' => __('Onderwijsinstelling'), 'value' => old('school_current')])

    @include('form.field-input', ['id' => 'profile_current', 'tag' => __('Opleiding'), 'value' => old('profile_current')])

    <div class="seperator"></div>




    <div class="title">{{ __('Educatie middelbare') }}</div>

    @include('form.field-input', ['id' => 'education_middelbare', 'tag' => __('Niveau'), 'value' => old('education_middelbare')])

    @include('form.field-input', ['id' => 'school_middelbare', 'tag' => __('School'), 'value' => old('school_middelbare')])

    @include('form.field-input', ['id' => 'profile_middelbare', 'tag' => __('Profiel'), 'icon' => 'search.svg', 'value' => old('profile_middelbare'), 'data' => true, 'show_all' => true])

    <div class="seperator"></div>




    <div class="title">{{ __('Arbeidgegevens') }}</div>

    @include('form.field-input', ['id' => 'motivation', 'tag' => __('Motivatie'), 'placeholder' => __('Waarom wil deze persoon bij Studied werken?'), 'value' => old('motivation')])

    @include('form.field-input', ['id' => 'capacity', 'tag' => __('Werkcapaciteit'), 'type' => 'number', 'placeholder' => __('Uren per week'), 'value' => old('capacity')])

    @include('form.field-input', ['id' => 'iban', 'tag' => __('Rekeningnummer (IBAN)'), 'value' => old('iban')])

    <div class="seperator"></div>



    <div class="title">{{ __('Profielgegevens') }}</div>

    @include('form.field-input', ['id' => 'social_instagram', 'tag' => __('Instagram'), 'placeholder' => __('Alleen gebruikersnaam'), 'value' => old('social_instagram')])

    @include('form.field-input', ['id' => 'social_linkedin', 'tag' => __('LinkedIn'), 'placeholder' => __('Gehele URL van het profiel'), 'value' => old('social_linkedin')])

    <div class="seperator"></div>



    <div class="title">{{ __('Bestanden') }}</div>

    @include('form.field-file', ['file' => 'cv', 'tag' => __('CV')])

    @include('form.field-file', ['file' => 'diploma', 'tag' => __('Diploma')])

    @include('form.field-file', ['file' => 'contract', 'tag' => __('Contract')])

    @include('form.field-file', ['file' => 'loonheffing', 'tag' => __('Loonheffing')])

    @include('form.field-file', ['file' => 'identificatie', 'tag' => __('Identificatie')])

    @include('form.field-file', ['file' => 'indiensttreding', 'tag' => __('Indiensttreding')])



@endsection
