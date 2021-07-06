<div class="block-attributes">

    <div class="title">Locatie</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ $study->getLocation_Defined ? "Naam" : "Omschrijving"}}</div>

            <div class="value">{{ $study->getLocation_Defined ? $study->getLocation_Defined->name : $study->getLocation_Text }}</div>

        </div>

        <div class="attribute">

            <div class="name">Adres</div>

            <div class="value">{{

                $study->getLocation_Defined ?

                    ($study->getLocation_Defined->getAddress ?

                        \App\Http\Traits\AddressTrait::getFormatted($study->getLocation_Defined->getAddress, \App\Http\Traits\AddressTrait::$FORMAT_STUDY)

                        :

                        "aa")

                    :

                    "Geen adres bekend"

            }}</div>

        </div>

    </div>

</div>
