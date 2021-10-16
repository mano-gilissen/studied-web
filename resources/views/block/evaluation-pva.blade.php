<div id="pva" class="block-attributes">

    <div class="title">Plan van Aanpak</div>



    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '1'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '2'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '3'}) > 0)

        <div class="subtitle">Goal - De doelstelling</div>

        <div class="content-fold">

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '1'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Wat wil de scholier bereiken?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '1'} }}</p>

                </div>

                <div class="seperator"></div>

            @endif

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '2'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Wat is het verwachte resultaat n.a.v. bijles bij Studied?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '2'} }}</p>

                </div>

                <div class="seperator"></div>

            @endif

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '3'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Wat is de looptijd van de doelstelling?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '3'} }}</p>

                </div>

            @endif

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '4'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '5'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '6'}) > 0)

        <div class="subtitle">Reality - Stand van zaken</div>

        <div class="content-fold">

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '4'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Hoe ziet de situatie er nu uit? Waarom is deze problematisch?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '4'} }}</p>

                </div>

                <div class="seperator"></div>

            @endif

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '5'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Wat is reeds ondernomen? Waarom werkte dat wel of niet?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '5'} }}</p>

                </div>

                <div class="seperator"></div>

            @endif

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '6'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Hoe ziet het eruit als de problematiek niet wordt opgelost?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '6'} }}</p>

                </div>

            @endif

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '7'}) > 0)

        <div class="subtitle">Options - De mogelijkheden</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>De mogelijkheden van de scholier bij Studied</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '7'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '8'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '9'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '10'}) > 0)

        <div class="subtitle">Will - De acties</div>

        <div class="content-fold">

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '8'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Worden er nog acties buiten Studied ondernomen?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '8'} }}</p>

                </div>

                <div class="seperator"></div>

            @endif

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '9'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Wat zijn mogelijke obstakels voor behalen van het gewenste resultaat? Hoe kan hier rekening mee worden gehouden?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '9'} }}</p>

                </div>

                <div class="seperator"></div>

            @endif

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '10'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Ons adviesplan</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_PVA . '10'} }}</p>

                </div>

            @endif

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_REMARKS}) > 0)

        <div class="subtitle">Extra afspraken of opmerkingen</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Opmerkingen</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_REMARKS} }}</p>

            </div>

        </div>

    @endif




</div>
