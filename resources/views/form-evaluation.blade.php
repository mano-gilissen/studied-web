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

        @include('form.field-textarea', ['id' => 'pva_1', 'tag' => 'Wat wil je bereiken?', 'value' => old('pva_1')])
        @include('form.field-textarea', ['id' => 'pva_2', 'tag' => 'Hoe weet je dat het doel is bereikt?', 'value' => old('pva_2')])
        @include('form.field-textarea', ['id' => 'pva_3', 'tag' => 'Is het doel acceptabel?', 'value' => old('pva_3')])
        @include('form.field-textarea', ['id' => 'pva_4', 'tag' => 'Is het doel realistisch?', 'value' => old('pva_4')])
        @include('form.field-textarea', ['id' => 'pva_5', 'tag' => 'Wanneer wil je het doel bereiken?', 'value' => old('pva_5')])

        <div class="seperator"></div>



        <div class="title">{{ __('PVA Reality - Stand van zaken') }}</div>

        @include('form.field-textarea', ['id' => 'pva_6', 'tag' => 'Hoe ziet de situatie er nu uit?', 'value' => old('pva_6')])
        @include('form.field-textarea', ['id' => 'pva_7', 'tag' => 'Waarom is de situatie problematisch?', 'value' => old('pva_7')])
        @include('form.field-textarea', ['id' => 'pva_8', 'tag' => 'Wat is reeds ondernomen om de problemen te verhelpen? Waarom werkte dat wel of niet?', 'value' => old('pva_8')])
        @include('form.field-textarea', ['id' => 'pva_9', 'tag' => 'Hoe ziet de situatie eruit als de problemen niet worden opgelost?', 'value' => old('pva_9')])

        <div class="seperator"></div>



        <div class="title">{{ __('PVA - Options - De mogelijkheden') }}</div>

        @include('form.field-textarea', ['id' => 'pva_10', 'tag' => 'Welke mogelijkheden heb je om het doel te bereiken?', 'value' => old('pva_10')])
        @include('form.field-textarea', ['id' => 'pva_11', 'tag' => 'Bij welke vakken kunnen we je ondersteunen om het doel te bereiken?', 'value' => old('pva_11')])
        @include('form.field-textarea', ['id' => 'pva_12', 'tag' => 'Door middel van welke diensten kunnen we deze vakken ondersteunen om het doel te bereiken?', 'value' => old('pva_12')])

        <div class="seperator"></div>



        <div class="title">{{ __('PVA - Will - De acties') }}</div>

        @include('form.field-textarea', ['id' => 'pva_13', 'tag' => 'Welke acties ga je buiten Studied ondernemen om het doel te bereiken?', 'value' => old('pva_13')])
        @include('form.field-textarea', ['id' => 'pva_14', 'tag' => 'Wat zijn mogelijke obstakels voor het behalen van het gewenste resultaat? Hoe kan hier rekening mee worden gehouden?', 'value' => old('pva_14')])
        @include('form.field-textarea', ['id' => 'pva_15', 'tag' => 'Ons adviesplan om het doel te bereiken.', 'Placeholder' => 'Wat wordt er als concludie van het voorgaande aangeraden? (Vak - periode - frequentie)', 'value' => old('pva_15')])

        <div class="seperator"></div>



        <div class="title">{{ __('Afspraken') }}</div>

        @include('form.field-textarea', ['id' => 'afs_1', 'tag' => 'Welke afspraken worden er gemaakt over de vakken, uren en looptijd? ', 'value' => old('afs_1')])
        @include('form.field-textarea', ['id' => 'afs_2', 'tag' => 'Zijn er nog andere afspraken gemaakt?', 'value' => old('afs_2')])
        @include('form.field-textarea', ['id' => 'afs_3', 'tag' => 'Wanneer wordt de uitvoering van de afspraken geëvalueerd?', 'value' => old('afs_3')])

        <div class="seperator"></div>



        <div class="title">{{ __('Proefles') }}</div>

        @include('form.field-textarea', ['id' => 'afs_4', 'tag' => 'Wat is er afgesproken over de proefles(sen)?', 'value' => old('afs_4')])

        <div class="seperator"></div>

    @endif



    @if(in_array($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}, array(\App\Http\Traits\EvaluationTrait::$ID_EVALUATION, \App\Http\Traits\EvaluationTrait::$ID_YEAR_END)))

        <div class="title">{{ __('Evaluatie') }}</div>

        @include('form.field-textarea', ['id' => 'eva_1', 'tag' => 'Hoe ervaart de leerling de begeleiding voor het bereiken van het doel?', 'value' => old('eva_1')])
        @include('form.field-textarea', ['id' => 'eva_2', 'tag' => 'Hoe ervaart de klant de begeleiding voor het bereiken van het doel?', 'value' => old('eva_2')])
        @include('form.field-textarea', ['id' => 'eva_3', 'tag' => 'Hoe ervaart de student-docent de begeleiding voor het bereiken van het doel?', 'value' => old('eva_3')])
        @include('form.field-textarea', ['id' => 'eva_4', 'tag' => 'Hoe kan de begeleiding worden verbeterd om het doel te behalen?  ', 'value' => old('eva_4')])

        <div class="seperator"></div>

    @endif



    @if($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING} = \App\Http\Traits\EvaluationTrait::$ID_YEAR_END)

        <div class="title">{{ __('Eind schooljaar') }}</div>

        @include('form.field-textarea', ['id' => 'ein_1', 'tag' => 'Hoe is het afgelopen schooljaar de scholier bevallen?', 'value' => old('ein_1')])

        <div class="seperator"></div>



        <div class="title">{{ __('Begeleiding') }}</div>

        @include('form.field-textarea', ['id' => 'ein_2', 'tag' => 'Wat vond je van de begeleiding dit afgelopen schooljaar?', 'value' => old('ein_2')])
        @include('form.field-textarea', ['id' => 'ein_3', 'tag' => 'Wat vind je een pluspunt van begeleiding bij Studied?', 'value' => old('ein_3')])
        @include('form.field-textarea', ['id' => 'ein_4', 'tag' => 'Wat vind je een minpunt van begeleiding bij Studied?', 'value' => old('ein_4')])
        @include('form.field-textarea', ['id' => 'ein_5', 'tag' => 'Wat kunnen we verbeteren aan de begeleiding van Studied?', 'value' => old('ein_5')])

        <div class="seperator"></div>



        <div class="title">{{ __('Webapp') }}</div>

        @include('form.field-textarea', ['id' => 'ein_6', 'tag' => 'Hoe vond je het gebruik van de webapp dit afgelopen schooljaar?', 'value' => old('ein_6')])
        @include('form.field-textarea', ['id' => 'ein_7', 'tag' => 'Wat vind je een pluspunt van de webapp?', 'value' => old('ein_7')])
        @include('form.field-textarea', ['id' => 'ein_8', 'tag' => 'Wat vind je een minpunt van de webapp?', 'value' => old('ein_8')])
        @include('form.field-textarea', ['id' => 'ein_9', 'tag' => 'Wat kunnen we verbeteren aan de webapp?', 'value' => old('ein_9')])

        <div class="seperator"></div>



        <div class="title">{{ __('Leslocatie') }}</div>

        @include('form.field-textarea', ['id' => 'ein_10', 'tag' => 'Hoe vond je de locatie van de lessen dit afgelopen schooljaar?', 'value' => old('ein_10')])
        @include('form.field-textarea', ['id' => 'ein_11', 'tag' => 'Wat vind je een pluspunt van begeleiding op deze leslocatie?', 'value' => old('ein_11')])
        @include('form.field-textarea', ['id' => 'ein_12', 'tag' => 'Wat vind je een minpunt van begeleiding op deze leslocatie?', 'value' => old('ein_12')])
        @include('form.field-textarea', ['id' => 'ein_13', 'tag' => 'Wat kunnen we verbeteren voor begeleiding op deze leslocatie?', 'value' => old('ein_13')])

        <div class="seperator"></div>



        <div class="title">{{ __('Volgend schooljaar') }}</div>

        @include('form.field-textarea', ['id' => 'ein_14', 'tag' => 'Wat gaat de scholier volgend schooljaar doen?', 'value' => old('ein_14')])
        @include('form.field-textarea', ['id' => 'ein_15', 'tag' => 'Wil de scholier volgend schooljaar weer begeleiding bij Studied?', 'value' => old('ein_15')])

        <div class="seperator"></div>

    @endif



    @if($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING} = \App\Http\Traits\EvaluationTrait::$ID_EXIT)

        <div class="title">{{ __('Exit') }}</div>

        @include('form.field-textarea', ['id' => 'ex_1', 'tag' => 'Wat vond je fijn aan begeleiding bij Studied?', 'value' => old('ex_1')])
        @include('form.field-textarea', ['id' => 'ex_2', 'tag' => 'Wat kunnen we verbeteren bij Studied?', 'value' => old('ex_2')])
        @include('form.field-textarea', ['id' => 'ex_3', 'tag' => 'Per wanneer ga je weg?', 'value' => old('ex_3')])
        @include('form.field-textarea', ['id' => 'ex_4', 'tag' => 'Waarom ga je weg?', 'value' => old('ex_4')])

        <div class="seperator"></div>



        <div class="title">{{ __('Begeleiding') }}</div>

        @include('form.field-textarea', ['id' => 'ex_5', 'tag' => 'Wat vond je van de begeleiding?', 'value' => old('ex_5')])
        @include('form.field-textarea', ['id' => 'ex_6', 'tag' => 'Wat vind je een pluspunt van begeleiding bij Studied?', 'value' => old('ex_6')])
        @include('form.field-textarea', ['id' => 'ex_7', 'tag' => 'Wat vind je een minpunt van begeleiding bij Studied?', 'value' => old('ex_7')])
        @include('form.field-textarea', ['id' => 'ex_8', 'tag' => 'Wat kunnen we verbeteren qua begeleiding bij Studied?', 'value' => old('ex_8')])

        <div class="seperator"></div>



        <div class="title">{{ __('Webapp') }}</div>

        @include('form.field-textarea', ['id' => 'ex_9', 'tag' => 'Hoe vond je het gebruik van de webapp?', 'value' => old('ex_9')])
        @include('form.field-textarea', ['id' => 'ex_10', 'tag' => 'Wat vind je een pluspunt van de webapp?', 'value' => old('ex_10')])
        @include('form.field-textarea', ['id' => 'ex_11', 'tag' => 'Wat vind je een minpunt van de webapp?', 'value' => old('ex_11')])
        @include('form.field-textarea', ['id' => 'ex_12', 'tag' => 'Wat kunnen we verbeteren aan de webapp?', 'value' => old('ex_12')])

        <div class="seperator"></div>



        <div class="title">{{ __('Leslocatie') }}</div>

        @include('form.field-textarea', ['id' => 'ex_13', 'tag' => 'Hoe vond je begeleiding op de leslocatie?', 'value' => old('ex_13')])
        @include('form.field-textarea', ['id' => 'ex_14', 'tag' => 'Wat vind je een pluspunt van begeleiding op de leslocatie?', 'value' => old('ex_14')])
        @include('form.field-textarea', ['id' => 'ex_15', 'tag' => 'Wat vind je een minpunt van begeleiding op de leslocatie?', 'value' => old('ex_15')])
        @include('form.field-textarea', ['id' => 'ex_16', 'tag' => 'Wat kunnen we verbeteren voor begeleiding op de leslocatie?', 'value' => old('ex_16')])

        <div class="seperator"></div>

    @endif



    <div class="title">{{ __('Overig') }}</div>

    @if(in_array($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}, array(\App\Http\Traits\EvaluationTrait::$ID_YEAR_END, \App\Http\Traits\EvaluationTrait::$ID_EXIT)))

        @include('form.field-textarea', ['id' => 'ov_1', 'tag' => 'Heb je nog andere suggesties voor Studied?', 'value' => old('ov_1')])

    @endif



    @include('form.field-textarea', ['id' => 'ov_2', 'tag' => 'Overige vragen of opmerkingen?', 'value' => old('ov_2')])

    <div class="seperator large"></div>



    <div id="agreements-wrap"></div>

    <div id="button-add-agreement" class="button grey" onclick="evaluation_agreement_load('{{ $evaluation->id }}');">Vakafspraak toevoegen</div>



    @include('form.field-hidden', ['id' => '_evaluation', 'value' => $evaluation->id])



@endsection
