@extends('template.form')



@section('scripts')

    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/evaluation.js') }}"></script>

@endsection



@section('fields')



    <div class="block-note">Dit is het gesprek van <span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($evaluation->getStudent->getPerson) }}</span></div>

    <div class="seperator"></div>



    @if(in_array($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}, array(\App\Http\Traits\EvaluationTrait::$ID_INTAKE, \App\Http\Traits\EvaluationTrait::$ID_EVALUATION, \App\Http\Traits\EvaluationTrait::$ID_YEAR_END)))

        <div class="title">{{ __('PVA Goal - De doelstelling') }}</div>

        @include('form.field-textarea', ['id' => 'q_1', 'tag' => 'Wat wil je bereiken?', 'value' => old('q_1')])
        @include('form.field-textarea', ['id' => 'q_2', 'tag' => 'Hoe weet je dat het doel is bereikt?', 'value' => old('q_2')])
        @include('form.field-textarea', ['id' => 'q_3', 'tag' => 'Is het doel acceptabel?', 'value' => old('q_3')])
        @include('form.field-textarea', ['id' => 'q_4', 'tag' => 'Is het doel realistisch?', 'value' => old('q_4')])
        @include('form.field-textarea', ['id' => 'q_5', 'tag' => 'Wanneer wil je het doel bereiken?', 'value' => old('q_5')])

        <div class="seperator"></div>



        <div class="title">{{ __('PVA Reality - Stand van zaken') }}</div>

        @include('form.field-textarea', ['id' => 'q_6', 'tag' => 'Hoe ziet de situatie er nu uit?', 'value' => old('q_6')])
        @include('form.field-textarea', ['id' => 'q_7', 'tag' => 'Waarom is de situatie problematisch?', 'value' => old('q_7')])
        @include('form.field-textarea', ['id' => 'q_8', 'tag' => 'Wat is reeds ondernomen om de problemen te verhelpen? Waarom werkte dat wel of niet?', 'value' => old('q_8')])
        @include('form.field-textarea', ['id' => 'q_9', 'tag' => 'Hoe ziet de situatie eruit als de problemen niet worden opgelost?', 'value' => old('q_9')])

        <div class="seperator"></div>



        <div class="title">{{ __('PVA - Options - De mogelijkheden') }}</div>

        @include('form.field-textarea', ['id' => 'q_10', 'tag' => 'Welke mogelijkheden heb je om het doel te bereiken?', 'value' => old('q_10')])
        @include('form.field-textarea', ['id' => 'q_11', 'tag' => 'Bij welke vakken kunnen we je ondersteunen om het doel te bereiken?', 'value' => old('q_11')])
        @include('form.field-textarea', ['id' => 'q_12', 'tag' => 'Door middel van welke diensten kunnen we deze vakken ondersteunen om het doel te bereiken?', 'value' => old('q_12')])

        <div class="seperator"></div>



        <div class="title">{{ __('PVA - Will - De acties') }}</div>

        @include('form.field-textarea', ['id' => 'q_13', 'tag' => 'Welke acties ga je buiten Studied ondernemen om het doel te bereiken?', 'value' => old('q_13')])
        @include('form.field-textarea', ['id' => 'q_14', 'tag' => 'Wat zijn mogelijke obstakels voor het behalen van het gewenste resultaat? Hoe kan hier rekening mee worden gehouden?', 'value' => old('q_14')])
        @include('form.field-textarea', ['id' => 'q_15', 'tag' => 'Ons adviesplan om het doel te bereiken.', 'Placeholder' => 'Wat wordt er als concludie van het voorgaande aangeraden? (Vak - periode - frequentie)', 'value' => old('q_15')])

        <div class="seperator"></div>



        <div class="title">{{ __('Afspraken') }}</div>

        @include('form.field-textarea', ['id' => 'q_16', 'tag' => 'Welke afspraken worden er gemaakt over de vakken, uren en looptijd? ', 'value' => old('q_16')])
        @include('form.field-textarea', ['id' => 'q_17', 'tag' => 'Zijn er nog andere afspraken gemaakt?', 'value' => old('q_17')])
        @include('form.field-textarea', ['id' => 'q_18', 'tag' => 'Wanneer wordt de uitvoering van de afspraken geëvalueerd?', 'value' => old('q_18')])

        <div class="seperator"></div>



        <div class="title">{{ __('Proefles') }}</div>

        @include('form.field-textarea', ['id' => 'q_19', 'tag' => 'Wat is er afgesproken over de proefles(sen)?', 'value' => old('q_19')])

        <div class="seperator"></div>

    @endif



    @if(in_array($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}, array(\App\Http\Traits\EvaluationTrait::$ID_EVALUATION, \App\Http\Traits\EvaluationTrait::$ID_YEAR_END)))

        <div class="title">{{ __('Evaluatie') }}</div>

        @include('form.field-textarea', ['id' => 'q_20', 'tag' => 'Hoe ervaart de leerling de begeleiding voor het bereiken van het doel?', 'value' => old('q_20')])
        @include('form.field-textarea', ['id' => 'q_21', 'tag' => 'Hoe ervaart de klant de begeleiding voor het bereiken van het doel?', 'value' => old('q_21')])
        @include('form.field-textarea', ['id' => 'q_22', 'tag' => 'Hoe ervaart de student-docent de begeleiding voor het bereiken van het doel?', 'value' => old('q_22')])
        @include('form.field-textarea', ['id' => 'q_23', 'tag' => 'Hoe kan de begeleiding worden verbeterd om het doel te behalen?  ', 'value' => old('q_23')])

        <div class="seperator"></div>

    @endif



    @if($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING} == \App\Http\Traits\EvaluationTrait::$ID_YEAR_END)

        <div class="title">{{ __('Eind schooljaar') }}</div>

        @include('form.field-textarea', ['id' => 'q_24', 'tag' => 'Hoe is het afgelopen schooljaar de scholier bevallen?', 'value' => old('q_24')])

        <div class="seperator"></div>



        <div class="title">{{ __('Begeleiding') }}</div>

        @include('form.field-textarea', ['id' => 'q_25', 'tag' => 'Wat vond je van de begeleiding dit afgelopen schooljaar?', 'value' => old('q_25')])
        @include('form.field-textarea', ['id' => 'q_26', 'tag' => 'Wat vind je een pluspunt van begeleiding bij Studied?', 'value' => old('q_26')])
        @include('form.field-textarea', ['id' => 'q_27', 'tag' => 'Wat vind je een minpunt van begeleiding bij Studied?', 'value' => old('q_27')])
        @include('form.field-textarea', ['id' => 'q_28', 'tag' => 'Wat kunnen we verbeteren aan de begeleiding van Studied?', 'value' => old('q_28')])

        <div class="seperator"></div>



        <div class="title">{{ __('Webapp') }}</div>

        @include('form.field-textarea', ['id' => 'q_29', 'tag' => 'Hoe vond je het gebruik van de webapp dit afgelopen schooljaar?', 'value' => old('q_29')])
        @include('form.field-textarea', ['id' => 'q_30', 'tag' => 'Wat vind je een pluspunt van de webapp?', 'value' => old('q_30')])
        @include('form.field-textarea', ['id' => 'q_31', 'tag' => 'Wat vind je een minpunt van de webapp?', 'value' => old('q_31')])
        @include('form.field-textarea', ['id' => 'q_32', 'tag' => 'Wat kunnen we verbeteren aan de webapp?', 'value' => old('q_32')])

        <div class="seperator"></div>



        <div class="title">{{ __('Leslocatie') }}</div>

        @include('form.field-textarea', ['id' => 'q_33', 'tag' => 'Hoe vond je de locatie van de lessen dit afgelopen schooljaar?', 'value' => old('q_33')])
        @include('form.field-textarea', ['id' => 'q_34', 'tag' => 'Wat vind je een pluspunt van begeleiding op deze leslocatie?', 'value' => old('q_34')])
        @include('form.field-textarea', ['id' => 'q_35', 'tag' => 'Wat vind je een minpunt van begeleiding op deze leslocatie?', 'value' => old('q_35')])
        @include('form.field-textarea', ['id' => 'q_36', 'tag' => 'Wat kunnen we verbeteren voor begeleiding op deze leslocatie?', 'value' => old('q_36')])

        <div class="seperator"></div>



        <div class="title">{{ __('Volgend schooljaar') }}</div>

        @include('form.field-textarea', ['id' => 'q_37', 'tag' => 'Wat gaat de scholier volgend schooljaar doen?', 'value' => old('q_37')])
        @include('form.field-textarea', ['id' => 'q_38', 'tag' => 'Wil de scholier volgend schooljaar weer begeleiding bij Studied?', 'value' => old('q_38')])

        <div class="seperator"></div>

    @endif



    @if($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING} == \App\Http\Traits\EvaluationTrait::$ID_EXIT)

        <div class="title">{{ __('Exit') }}</div>

        @include('form.field-textarea', ['id' => 'q_39', 'tag' => 'Wat vond je fijn aan begeleiding bij Studied?', 'value' => old('q_39')])
        @include('form.field-textarea', ['id' => 'q_40', 'tag' => 'Wat kunnen we verbeteren bij Studied?', 'value' => old('q_40')])
        @include('form.field-textarea', ['id' => 'q_41', 'tag' => 'Per wanneer ga je weg?', 'value' => old('q_41')])
        @include('form.field-textarea', ['id' => 'q_42', 'tag' => 'Waarom ga je weg?', 'value' => old('q_42')])

        <div class="seperator"></div>



        <div class="title">{{ __('Begeleiding') }}</div>

        @include('form.field-textarea', ['id' => 'q_43', 'tag' => 'Wat vond je van de begeleiding?', 'value' => old('q_43')])
        @include('form.field-textarea', ['id' => 'q_44', 'tag' => 'Wat vind je een pluspunt van begeleiding bij Studied?', 'value' => old('q_44')])
        @include('form.field-textarea', ['id' => 'q_45', 'tag' => 'Wat vind je een minpunt van begeleiding bij Studied?', 'value' => old('q_45')])
        @include('form.field-textarea', ['id' => 'q_46', 'tag' => 'Wat kunnen we verbeteren qua begeleiding bij Studied?', 'value' => old('q_46')])

        <div class="seperator"></div>



        <div class="title">{{ __('Webapp') }}</div>

        @include('form.field-textarea', ['id' => 'q_47', 'tag' => 'Hoe vond je het gebruik van de webapp?', 'value' => old('q_47')])
        @include('form.field-textarea', ['id' => 'q_48', 'tag' => 'Wat vind je een pluspunt van de webapp?', 'value' => old('q_48')])
        @include('form.field-textarea', ['id' => 'q_49', 'tag' => 'Wat vind je een minpunt van de webapp?', 'value' => old('q_49')])
        @include('form.field-textarea', ['id' => 'q_50', 'tag' => 'Wat kunnen we verbeteren aan de webapp?', 'value' => old('q_50')])

        <div class="seperator"></div>



        <div class="title">{{ __('Leslocatie') }}</div>

        @include('form.field-textarea', ['id' => 'q_51', 'tag' => 'Hoe vond je begeleiding op de leslocatie?', 'value' => old('q_51')])
        @include('form.field-textarea', ['id' => 'q_52', 'tag' => 'Wat vind je een pluspunt van begeleiding op de leslocatie?', 'value' => old('q_52')])
        @include('form.field-textarea', ['id' => 'q_53', 'tag' => 'Wat vind je een minpunt van begeleiding op de leslocatie?', 'value' => old('q_53')])
        @include('form.field-textarea', ['id' => 'q_54', 'tag' => 'Wat kunnen we verbeteren voor begeleiding op de leslocatie?', 'value' => old('q_54')])

        <div class="seperator"></div>

    @endif



    <div class="title">{{ __('Overig') }}</div>

    @if(in_array($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}, array(\App\Http\Traits\EvaluationTrait::$ID_YEAR_END, \App\Http\Traits\EvaluationTrait::$ID_EXIT)))

        @include('form.field-textarea', ['id' => 'q_55', 'tag' => 'Heb je nog andere suggesties voor Studied?', 'value' => old('q_55')])

    @endif



    @include('form.field-textarea', ['id' => 'q_56', 'tag' => 'Overige vragen of opmerkingen?', 'value' => old('q_56')])

    <div class="seperator large"></div>



    <div id="agreements-wrap"></div>

    <div id="button-add-agreement" class="button grey" onclick="evaluation_agreement_load('{{ $evaluation->id }}');">Vakafspraak toevoegen</div>



    @include('form.field-hidden', ['id' => '_evaluation', 'value' => $evaluation->id])



@endsection
