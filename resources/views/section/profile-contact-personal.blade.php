<div class="block-attributes">

    @if($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_CUSTOMER && $person->getUser->{\App\Http\Support\Model::$USER_CATEGORY} == \App\Http\Traits\RoleTrait::$CATEGORY_CUSTOMER_COMPANY)

        <div class="title">{{ __('Bedrijfsgegevens') }}</div>

    @else

        <div class="title">{{ __('Persoonlijk') }}</div>

    @endif

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ __('Email') }}</div>

            <div class="value">{{ $person->getUser->{\App\Http\Support\Model::$USER_EMAIL} ?? __('Onbekend') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Telefoon') }}</div>

            <div class="value">{{ $person->{\App\Http\Support\Model::$PERSON_PHONE} ?? __('Onbekend') }}</div>

        </div>

        @if(!(($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_BOARD) && (Auth::user()->role == \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)))

            <div class="attribute">

                <div class="name">{{ __('Adres') }}</div>

                <div class="value">{{ \App\Http\Traits\AddressTrait::getFormatted($person->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) }}</div>

            </div>

            @if($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_CUSTOMER && $person->getUser->{\App\Http\Support\Model::$USER_CATEGORY} == \App\Http\Traits\RoleTrait::$CATEGORY_CUSTOMER_COMPANY)

                <div class="attribute">

                    <div class="name">{{ __('Contactpersoon') }}</div>

                    <div class="value">{{ \App\Http\Traits\PersonTrait::getFullName($person)  }}</div>

                </div>

            @else

                <div class="attribute">

                    <div class="name">{{ __('Geboortedatum') }}</div>

                    <div class="value">{{ $person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE} ? \App\Http\Support\Format::datetime($person->{\App\Http\Support\Model::$PERSON_BIRTH_DATE}, \App\Http\Support\Format::$DATETIME_PROFILE) : __('Onbekend') }}</div>

                </div>

            @endif

        @endif

        @if(\App\Http\Traits\BaseTrait::hasManagementRights())

            <div class="attribute">

                <div class="name">{{ __('Referentie') }}</div>

                <div class="value">{{ __($person->{\App\Http\Support\Model::$PERSON_REFER}) ? $person->{\App\Http\Support\Model::$PERSON_REFER} : __('Onbekend') }}</div>

            </div>

        @endif

    </div>

</div>
