<div class="block-attributes">

    <div class="title">Locatie</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? "Platform" : ($evaluation->getAddress ? "Naam" : "Omschrijving") }}</div>

            <div class="value">{{ \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? "Digitaal" : $evaluation->{\App\Http\Support\Model::$STUDY_LOCATION_TEXT} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? "Link gesprek" : "Adres" }}</div>

            <div class="value">{!! \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? '<a href="' . $evaluation->link . '">' . $evaluation->link . '</a>' : ($evaluation->getAddress ? \App\Http\Traits\AddressTrait::getFormatted($evaluation->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) : "Geen adres bekend") !!}</div>

        </div>

    </div>

</div>
