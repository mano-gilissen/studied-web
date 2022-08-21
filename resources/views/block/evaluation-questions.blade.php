<div id="pva" class="block-attributes">



    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '1'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '2'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '3'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '4'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '5'}) > 0)

        <div class="title">Plan van Aanpak</div>

        <div class="subtitle">Goal - De doelstelling</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Wat wil je bereiken?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '1'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Hoe weet je dat het doel is bereikt?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '2'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Is het doel acceptabel?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '3'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Is het doel realistisch?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '4'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wanneer wil je het doel bereiken?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '5'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '6'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '7'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '8'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '9'}) > 0)

        <div class="subtitle">Reality - Stand van zaken</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe ziet de situatie er nu uit?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '6'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Waarom is de situatie problematisch?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '7'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat is reeds ondernomen om de problemen te verhelpen? Waarom werkte dat wel of niet?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '8'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Hoe ziet de situatie eruit als de problemen niet worden opgelost?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '9'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '10'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '11'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '12'}) > 0)

        <div class="subtitle">Options - De mogelijkheden</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Welke mogelijkheden heb je om het doel te bereiken?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '10'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Bij welke vakken kunnen we je ondersteunen om het doel te bereiken?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '11'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Door middel van welke diensten kunnen we deze vakken ondersteunen om het doel te bereiken?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '12'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '13'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '14'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '15'}) > 0)

        <div class="subtitle">Will - De acties</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Welke acties ga je buiten Studied ondernemen om het doel te bereiken?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '13'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat zijn mogelijke obstakels voor het behalen van het gewenste resultaat? Hoe kan hier rekening mee worden gehouden?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '14'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Ons adviesplan om het doel te bereiken.</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '15'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '16'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '17'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '18'}) > 0)

        <div class="subtitle">Afspraken</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Welke afspraken worden er gemaakt over de vakken, uren en looptijd?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '16'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Zijn er nog andere afspraken gemaakt?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '17'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wanneer wordt de uitvoering van de afspraken geëvalueerd?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '18'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '19'}) > 0)

        <div class="subtitle">Proefles</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Wat is er afgesproken over de proefles(sen)?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '19'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '20'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '21'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '22'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '23'}) > 0)

        <div class="title">Evaluatie</div>

        <div class="subtitle">Bevindingen</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe ervaart de leerling de begeleiding voor het bereiken van het doel?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '20'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Hoe ervaart de klant de begeleiding voor het bereiken van het doel?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '21'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Hoe ervaart de student-docent de begeleiding voor het bereiken van het doel?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '22'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Hoe kan de begeleiding worden verbeterd om het doel te behalen?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '23'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '24'}) > 0)

        <div class="title">Afgelopen schooljaar</div>

        <div class="subtitle">Bevindingen</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe is het afgelopen schooljaar de scholier bevallen?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '24'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '25'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '26'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '27'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '28'}) > 0)

        <div class="subtitle">Begeleiding</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Wat vond je van de begeleiding dit afgelopen schooljaar?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '25'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een pluspunt van begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '26'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een minpunt van begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '27'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren aan de begeleiding van Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '28'} }}</p>

            </div>

        </div>

    @endif





    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '29'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '30'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '31'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '32'}) > 0)

        <div class="subtitle">Webapp</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe vond je het gebruik van de webapp dit afgelopen schooljaar?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '29'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een pluspunt van de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '30'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een minpunt van de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '31'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren aan de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '32'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '33'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '34'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '35'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '36'}) > 0)

        <div class="subtitle">Leslocatie</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe vond je de locatie van de lessen dit afgelopen schooljaar?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '33'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een pluspunt van begeleiding op deze leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '34'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een minpunt van begeleiding op deze leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '35'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren voor begeleiding op deze leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '36'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '37'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '38'}) > 0)

        <div class="subtitle">Volgend schooljaar</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Wat gaat de scholier volgend schooljaar doen?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '37'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wil de scholier volgend schooljaar weer begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '38'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '39'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '40'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '41'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '42'}) > 0)

        <div class="title">Einde begeleiding</div>

        <div class="subtitle">Bevindingen</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Wat vond je fijn aan begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '39'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '40'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Per wanneer ga je weg?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '41'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Waarom ga je weg?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '42'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '43'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '44'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '45'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '46'}) > 0)

        <div class="subtitle">Begeleiding</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Wat vond je van de begeleiding?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '43'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een pluspunt van begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '44'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een minpunt van begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '45'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren qua begeleiding bij Studied?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '46'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '47'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '48'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '49'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '50'}) > 0)

        <div class="subtitle">Webapp</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe vond je het gebruik van de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '47'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een pluspunt van de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '48'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een minpunt van de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '49'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren aan de webapp?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '50'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '51'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '52'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '53'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '54'}) > 0)

        <div class="subtitle">Leslocatie</div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Hoe vond je begeleiding op de leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '51'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een pluspunt van begeleiding op de leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '52'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat vind je een minpunt van begeleiding op de leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '53'} }}</p>

            </div>

            <div class="item">

                <div class="item-title">

                    <div>Wat kunnen we verbeteren voor begeleiding op de leslocatie?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '54'} }}</p>

            </div>

        </div>

    @endif




    @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '55'}) > 0 ||
        strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '56'}) > 0)

        <div class="subtitle">Overig</div>

        <div class="content-fold">

            @if(strlen($evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '55'}) > 0)

                <div class="item">

                    <div class="item-title">

                        <div>Heb je nog andere suggesties voor Studied?</div>

                        <img src="/images_app/chevron-down.svg">

                    </div>

                    <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '55'} }}</p>

                </div>

            @endif

            <div class="item">

                <div class="item-title">

                    <div>Overige vragen of opmerkingen?</div>

                    <img src="/images_app/chevron-down.svg">

                </div>

                <p>{{ $evaluation->{\App\Http\Support\Model::$EVALUATION_QUESTION . '56'} }}</p>

            </div>

        </div>

    @endif




</div>
