@extends('form.template')



@section('fields')

    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('component.field-input', ['id' => 'prefix', 'tag' => __('Titel'), 'placeholder' => __('Selecteer..'), 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_PREFIX}])

    @include('component.field-input', ['id' => 'first_name', 'tag' => __('Voornaam'), 'required' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME}])

    @include('component.field-input', ['id' => 'middle_name', 'tag' => __('Tussenvoegsel'), 'value' => $person->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME}])

    @include('component.field-input', ['id' => 'last_name', 'tag' => __('Achternaam'), 'required' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_LAST_NAME}])

    @if(\App\Http\Traits\PersonTrait::isCompany($person))

        @include('component.field-input', ['id' => 'company', 'tag' => __('Bedrijfsnaam'), 'required' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_COMPANY}])

    @else

        @include('component.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => __('Geboortedatum'), 'required' => true, 'placeholder' => __('Kies een datum'), 'value' => ($person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE} ? \App\Http\Support\Format::datetime($person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE}, \App\Http\Support\Format::$DATETIME_FORM) : __('Onbekend'))])

    @endif

    @include('component.field-input', ['id' => 'language', 'tag' => __('Taal'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'reject_others' => true, 'show_always' => true, 'ac_data' => 'language', 'uses_id' => true, 'set_id' => $person->getUser->{\App\Http\Support\Model::$USER_LANGUAGE}, 'value' => \App\Http\Middleware\Locale::getOption_text($person->getUser->{\App\Http\Support\Model::$USER_LANGUAGE})])

    @include('component.field-input', ['id' => 'refer', 'tag' => __('Referentie'), 'placeholder' => __('Hoe komt deze persoon bij Studied terecht?'), 'icon' => 'dropdown.svg', 'required' => true, 'data' => true, 'show_all' => true, 'show_always' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_REFER}])

    <div class="seperator"></div>



    <div class="title">{{ __('Contact- en accountgegevens') }}</div>

    @include('component.field-input', ['id' => 'email', 'type' => 'email', 'tag' => __('Email adres'), 'required' => true, 'value' => $person->getUser->{\App\Http\Support\Model::$USER_EMAIL}])

    @include('component.field-input', ['id' => 'phone', 'type' => 'phone', 'tag' => __('Telefoonnummer'), 'placeholder' => __('Telefoonnummer met landcode'), 'value' => $person->{\App\Http\Support\Model::$PERSON_PHONE}])

    @include('component.field-input', ['id' => 'status', 'tag' => __('Status'), 'icon' => 'dropdown.svg', 'placeholder' => __('Kies een status'), 'required' => true, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => !(\App\Http\Traits\UserTrait::isActivated($person->getUser)), 'set_id' => $person->getUser->{\App\Http\Support\Model::$USER_STATUS}])

    <div class="seperator"></div>



    <div class="title">{{ __('Adresgegevens') }}</div>

    @include('component.field-input', ['id' => 'street', 'tag' => __('Straatnaam'), 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_STREET}])

    <div class="field">

        <div class="name">Huisnummer</div>

        @include('component.box-input', ['id' => 'number', 'required' => true, 'size' => 'width-third', 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_NUMBER}])

        <div class="name width-third">Toevoeging</div>

        @include('component.box-input', ['id' => 'addition', 'size' => 'width-third', 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_ADDITION}])

    </div>

    @include('component.field-input', ['id' => 'zipcode', 'tag' => __('Postcode'), 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_ZIPCODE}])

    @include('component.field-input', ['id' => 'city', 'tag' => __('Stad'), 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_CITY}])

    @include('component.field-input', ['id' => 'country', 'tag' => __('Land'), 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_COUNTRY}])

    <div class="seperator"></div>



    @if (\App\Http\Traits\PersonTrait::isUser($person))

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                @include('component.part-employee-edit', ['employee' => $person->getUser->getEmployee])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @include('component.part-student-edit', ['student' => $person->getUser->getStudent])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @include('component.part-customer-edit', ['customer' => $person->getUser->getCustomer])

                @break

        @endswitch

    @else

        <!-- TODO: ADD RELATION AND PARTICIPANT -->

    @endif



    <div class="title">{{ __('Acties') }}</div>

    <div class="field">

        <div class="name">{{ __('Verwijderen') }}</div>

        <div class="button red" style="margin-top: 4px;"
             onclick="navigate('{{ route('person.delete', [\App\Http\Support\Model::$PERSON_SLUG => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}')">

            @if(\App\Http\Traits\PersonTrait::isUser($person))

                <div class="text">{{ __('Gebruiker verwijderen') }}</div>

            @else

                <!-- TODO: ADD RELATION AND PARTICIPANT -->

            @endif

        </div>

    </div>



    @include('component.field-hidden', ['id' => '_person', 'value' => $person->id])

@endsection
