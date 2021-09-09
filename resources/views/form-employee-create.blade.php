@extends('template.form')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('form.field-input', ['id' => 'prefix', 'tag' => 'Titel', 'placeholder' => 'Selecteer..', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'value' => old('prefix')])

    @include('form.field-input', ['id' => 'first_name', 'tag' => 'Voornaam', 'required' => true, 'value' => old('first_name')])

    @include('form.field-input', ['id' => 'middle_name', 'tag' => 'Tussenvoegsel', 'value' => old('middle_name')])

    @include('form.field-input', ['id' => 'last_name', 'tag' => 'Achternaam', 'required' => true, 'value' => old('last_name')])

    @include('form.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => 'Geboortedatum', 'placeholder' => 'Kies een datum', 'required' => true, 'value' => old('birth_date')])

    @include('form.field-input', ['id' => 'refer', 'tag' => 'Referentie', 'placeholder' => 'Hoe komt deze persoon bij Studied terecht?', 'required' => true, 'value' => old('refer')])

    <div class="seperator"></div>



    <div class="title">{{ __('Contact- en inloggegevens') }}</div>

    @include('form.field-input', ['id' => 'email', 'type' => 'email', 'tag' => 'Email adres', 'required' => true, 'value' => old('email')])

    @include('form.field-input', ['id' => 'phone', 'type' => 'phone', 'tag' => 'Telefoonnummer', 'placeholder' => 'Telefoonnummer met landcode', 'value' => old('phone')])

    <div class="seperator"></div>



    <div class="title">{{ __('Woonadres') }}</div>

    @include('form.field-input', ['id' => 'street', 'tag' => 'Straatnaam', 'required' => true, 'value' => old('street')])

    <div class="field">

        <div class="name">Huisnummer</div>

        @include('form.box-input', ['id' => 'number', 'required' => true, 'size' => 'width-third', 'value' => old('number')])

        <div class="note width-third">Toevoeging</div>

        @include('form.box-input', ['id' => 'addition', 'size' => 'width-third', 'value' => old('addition')])

    </div>

    @include('form.field-input', ['id' => 'zipcode', 'tag' => 'Postcode', 'required' => true, 'value' => old('zipcode')])

    @include('form.field-input', ['id' => 'city', 'tag' => 'Stad', 'required' => true, 'value' => old('city')])

    @include('form.field-input', ['id' => 'country', 'tag' => 'Land', 'required' => true, 'value' => old('country')])

    <div class="seperator"></div>



    <div class="title">{{ __('Educatie huidig') }}</div>

    @include('form.field-input', ['id' => 'education_current', 'tag' => 'Niveau', 'value' => old('education_current')])

    @include('form.field-input', ['id' => 'school_current', 'tag' => 'School', 'value' => old('school_current')])

    @include('form.field-input', ['id' => 'profile_current', 'tag' => 'Profiel', 'value' => old('profile_current')])

    <div class="seperator"></div>




    <div class="title">{{ __('Educatie middelbare') }}</div>

    @include('form.field-input', ['id' => 'education_middelbare', 'tag' => 'Niveau', 'value' => old('education_middelbare')])

    @include('form.field-input', ['id' => 'school_middelbare', 'tag' => 'School', 'value' => old('school_middelbare')])

    @include('form.field-input', ['id' => 'profile_middelbare', 'tag' => 'Profiel', 'value' => old('profile_middelbare')])

    <div class="seperator"></div>




    <div class="title">{{ __('Arbeidgegevens') }}</div>

    @include('form.field-input', ['id' => 'motivation', 'tag' => 'Motivatie', 'placeholder' => 'Waarom wil deze persoon bij Studied werken?', 'value' => old('motivation')])

    @include('form.field-input', ['id' => 'refer', 'tag' => 'Referentie', 'placeholder' => 'Hoe komt deze persoon bij Studied terecht?', 'value' => old('refer')])

    @include('form.field-input', ['id' => 'capacity', 'tag' => 'Werkcapaciteit', 'type' => 'number', 'placeholder' => 'Uren per week', 'value' => old('capacity')])

    @include('form.field-input', ['id' => 'iban', 'tag' => 'Rekeningnummer (IBAN)', 'value' => old('iban')])

    <div class="seperator"></div>



    <div class="title">{{ __('Profielgegevens') }}</div>

    @include('form.field-input', ['id' => 'profile_text', 'tag' => 'Profieltekst'])

    @include('form.field-input', ['id' => 'social_instagram', 'tag' => 'Instagram'])

    @include('form.field-input', ['id' => 'social_linkedin', 'tag' => 'LinkedIn'])

    <div class="seperator"></div>



    <div class="title">{{ __('Bestanden') }}</div>

    @include('form.field-file', ['file' => 'cv', 'tag' => 'CV'])

    @include('form.field-file', ['file' => 'diploma', 'tag' => 'Diploma'])

    @include('form.field-file', ['file' => 'contract', 'tag' => 'Contract'])

    @include('form.field-file', ['file' => 'loonheffing', 'tag' => 'Loonheffing'])

    @include('form.field-file', ['file' => 'identificatie', 'tag' => 'Identificatie'])

    @include('form.field-file', ['file' => 'indiensttreding', 'tag' => 'Indiensttreding'])



@endsection
