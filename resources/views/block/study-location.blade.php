<div class="block-attributes">

    <div class="title">Locatie</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\StudyTrait::hasLink($study) ? "Platform" : ($study->getAddress ? "Naam" : "Omschrijving") }}</div>

            <div class="value">{{ \App\Http\Traits\StudyTrait::hasLink($study) ? "Zoom (Digitaal)" : $study->{\App\Http\Support\Model::$STUDY_LOCATION_TEXT} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\StudyTrait::hasLink($study) ? "Link les" : "Adres" }}</div>

            <div class="value">{{  \App\Http\Traits\StudyTrait::hasLink($study) ? $study->link : ($study->getAddress ? \App\Http\Traits\AddressTrait::getFormatted($study->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) : "Geen adres bekend") }}</div>

        </div>

    </div>

</div>
