@extends('template.form')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('form.field-input', ['id' => 'prefix', 'tag' => 'Titel', 'placeholder' => 'Selecteer..', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'reject_other' => true])

    @include('form.field-input', ['id' => 'first_name', 'tag' => 'Voornaam', 'required' => true])

    @include('form.field-input', ['id' => 'middle_name', 'tag' => 'Tussenvoegsel'])

    @include('form.field-input', ['id' => 'last_name', 'tag' => 'Achternaam', 'required' => true])

    @include('form.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => 'Geboortedatum', 'placeholder' => 'Kies een datum', 'required' => true])

    <div class="seperator"></div>



    <div class="title">{{ __('Contactgegevens') }}</div>

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

    @include('form.field-input', ['id' => 'refer', 'tag' => 'Referentie', 'placeholder' => 'Hoe komt de klant bij Studied terecht?', 'required' => true])



@endsection
