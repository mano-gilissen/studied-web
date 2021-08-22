<div class="block-attributes">

    <div class="title">Locatie</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ $study->getAddress ? "Naam" : "Omschrijving"}}</div>

            <div class="value">{{ $study->{\App\Http\Support\Model::$STUDY_LOCATION_TEXT} }}</div>

        </div>

        <div class="attribute">

            <div class="name">Adres</div>

            <div class="value">{{ $study->getAddress ? \App\Http\Traits\AddressTrait::getFormatted($study->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) : "Geen adres bekend" }}</div>

        </div>

    </div>

</div>
