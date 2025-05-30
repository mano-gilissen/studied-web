<div class="block-attributes">

    <div class="title">{{ __('Locatie') }}</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\StudyTrait::hasLink($study) ? __("Platform") : ($study->getAddress ? __("Naam") : __("Omschrijving")) }}</div>

            <div class="value">{{ \App\Http\Traits\StudyTrait::hasLink($study) ? __("Digitaal") : $study->{\App\Http\Support\Model::$STUDY_LOCATION_TEXT} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ \App\Http\Traits\StudyTrait::hasLink($study) ? __("Link les") : __("Adres") }}</div>

            <div class="value">{!! \App\Http\Traits\StudyTrait::hasLink($study) ? '<a href="' . $study->link . '">' . $study->link . '</a>' : ($study->getAddress ? \App\Http\Traits\AddressTrait::getFormatted($study->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY) : __("Geen adres bekend")) !!}</div>

        </div>

    </div>

</div>
