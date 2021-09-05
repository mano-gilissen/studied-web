@extends('template.form')



@section('fields')



    <div class="title">{{ __('Persoonsgegevens') }}</div>

    @include('form.field-input', ['id' => 'prefix', 'tag' => 'Titel', 'placeholder' => 'Selecteer..', 'data' => true, 'icon' => 'search.svg', 'required' => true, 'show_all' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_PREFIX}])

    @include('form.field-input', ['id' => 'first_name', 'tag' => 'Voornaam', 'required' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME}])

    @include('form.field-input', ['id' => 'middle_name', 'tag' => 'Tussenvoegsel', 'value' => $person->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME}])

    @include('form.field-input', ['id' => 'last_name', 'tag' => 'Achternaam', 'required' => true, 'value' => $person->{\App\Http\Support\Model::$PERSON_LAST_NAME}])

    @include('form.field-input', ['id' => 'birth_date', 'type' => 'date', 'tag' => 'Geboortedatum', 'placeholder' => 'Kies een datum', 'required' => true, 'value' => \App\Http\Support\Format::datetime($person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE}, \App\Http\Support\Format::$DATETIME_FORM)])

    <div class="seperator"></div>



    <div class="title">{{ __('Contact- en inloggegevens') }}</div>

    @include('form.field-input', ['id' => 'email', 'type' => 'email', 'tag' => 'Email adres', 'required' => true, 'value' => $person->getUser->{\App\Http\Support\Model::$USER_EMAIL}])

    @include('form.field-input', ['id' => 'phone', 'type' => 'phone', 'tag' => 'Telefoonnummer', 'placeholder' => 'Telefoonnummer met landcode', 'value' => $person->{\App\Http\Support\Model::$PERSON_PHONE}])

    <div class="seperator"></div>



    <div class="title">{{ __('Woonadres') }}</div>

    @include('form.field-input', ['id' => 'street', 'tag' => 'Straatnaam', 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_STREET}])

    <div class="field">

        <div class="name">Huisnummer</div>

        @include('form.box-input', ['id' => 'number', 'required' => true, 'size' => 'width-third', 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_NUMBER}])

        <div class="note width-third">Toevoeging</div>

        @include('form.box-input', ['id' => 'addition', 'size' => 'width-third', 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_ADDITION}])

    </div>

    @include('form.field-input', ['id' => 'zipcode', 'tag' => 'Postcode', 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_ZIPCODE}])

    @include('form.field-input', ['id' => 'city', 'tag' => 'Stad', 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_CITY}])

    @include('form.field-input', ['id' => 'country', 'tag' => 'Land', 'required' => true, 'value' => $person->getAddress->{\App\Http\Support\Model::$ADDRESS_COUNTRY}])

    <div class="seperator"></div>



    @if (\App\Http\Traits\PersonTrait::isUser($person))

        @switch($person->getUser->role)

            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                @include('form.part-employee-edit', ['employee' => $person->getUser->getEmployee])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                @include('form.part-student-edit', ['student' => $person->getUser->getStudent])

                @break

            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                @include('form.part-customer-edit', ['customer' => $person->getUser->getCustomer])

                @break

        @endswitch

    @else

        <!-- TODO: ADD RELATION AND PARTICIPANT -->

    @endif



    <div class="title">{{ __('Acties') }}</div>

    <div class="field">

        <div class="name">Verwijderen</div>

        <div class="button red" style="margin-top: 4px;" onclick="window.location.href='{{ route('person.delete', [\App\Http\Support\Model::$PERSON_SLUG => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}'">

            @if(\App\Http\Traits\PersonTrait::isUser($person))

                <div class="text">Gebruiker verwijderen</div>

            @else

                <!-- TODO: ADD RELATION AND PARTICIPANT -->

            @endif

        </div>

    </div>



    @include('form.field-hidden', ['id' => '_person', 'value' => $person->id])



@endsection
