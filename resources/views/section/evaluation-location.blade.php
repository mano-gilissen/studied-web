<div class="block-attributes">

    <div class="title">{{ __('Locatie') }}</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? __("Platform") : ($evaluation->getAddress ? __("Naam") : __("Omschrijving")) }}</div>

            <div class="value">{{ \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? __("Digitaal") : $evaluation->{\App\Http\Support\Model::$STUDY_LOCATION_TEXT} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? __("Link gesprek") : __("Adres") }}</div>

            <div class="value">{!! \App\Http\Traits\EvaluationTrait::hasLink($evaluation) ? '<a href="' . $evaluation->link . '">' . $evaluation->link . '</a>' : ($evaluation->getAddress ? \App\Http\Traits\AddressTrait::getFormatted($evaluation->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) : __("Geen adres bekend")) !!}</div>

        </div>

    </div>

</div>
