@extends('form.template')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('component.field-input', ['id' => 'prefix', 'tag' => __('Titel') . '*', 'placeholder' => __('Selecteer..'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true, 'value' => old('prefix')])

    @include('component.field-input', ['id' => 'first_name', 'tag' => __('Voornaam') . '*', 'required' => true, 'value' => old('first_name')])

    @include('component.field-input', ['id' => 'middle_name', 'tag' => __('Tussenvoegsel'), 'value' => old('middle_name')])

    @include('component.field-input', ['id' => 'last_name', 'tag' => __('Achternaam') . '*', 'required' => true, 'value' => old('last_name')])

    @include('component.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => __('Geboortedatum') . '*', 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => old('birth_date')])

    @include('component.field-input', ['id' => 'language', 'tag' => __('Taal') . '*', 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'ac_data' => 'language', 'uses_id' => true, 'set_id' => old('_language') ?? \App\Http\Middleware\Locale::LOCALE_NL])

    @include('component.field-input', ['id' => 'refer', 'tag' => __('Referentie') . '*', 'placeholder' => __('Hoe komt deze persoon bij Studied terecht?'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'value' => old('refer')])

    <div class="seperator"></div>



    <div class="title">{{ __('Contact- en inloggegevens') }}</div>

    @include('component.field-input', ['id' => 'email', 'type' => 'email', 'tag' => __('Email adres') . '*', 'required' => true, 'value' => old('email')])

    @include('component.field-input', ['id' => 'phone', 'type' => 'phone', 'tag' => __('Telefoonnummer'), 'placeholder' => __('Telefoonnummer met landcode'), 'value' => old('phone')])

    <div class="seperator"></div>



    <div class="title">{{ __('Woonadres') }}</div>

    @include('component.field-input', ['id' => 'street', 'tag' => __('Straatnaam') . '*', 'required' => true, 'value' => old('street')])

    <div class="field">

        <div class="name">{{ __('Huisnummer') . '*' }}</div>

        @include('component.box-input', ['id' => 'number', 'required' => true, 'size' => 'width-third', 'value' => old('number')])

        <div class="name width-third">{{ __('Toevoeging') }}</div>

        @include('component.box-input', ['id' => 'addition', 'size' => 'width-third', 'value' => old('addition')])

    </div>

    @include('component.field-input', ['id' => 'zipcode', 'tag' => __('Postcode') . '*', 'required' => true, 'value' => old('zipcode')])

    @include('component.field-input', ['id' => 'city', 'tag' => __('Stad') . '*', 'required' => true, 'value' => old('city')])

    @include('component.field-input', ['id' => 'country', 'tag' => __('Land') . '*', 'required' => true, 'value' => old('country')])

    <div class="seperator"></div>



    @include('component.field-input', ['id' => 'category', 'tag' => __('Categorie') . '*', 'placeholder' => __('Welk soort klant is deze persoon?'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'uses_id' => true, 'set_id' => old('_category')])

    @include('component.field-input', ['id' => 'company', 'tag' => __('Bedrijfsnaam'), 'value' => old('company')])

    <div class="seperator"></div>



@endsection
