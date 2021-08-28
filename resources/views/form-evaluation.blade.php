@extends('template.form')



@section('fields')



    <div class="block-note">Dit is de evaluatie van <span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($evaluation->getStudent->getPerson) }}</span></div>

    <div class="seperator"></div>



    <div class="title">{{ __('Goal - De doelstelling') }}</div>

    @include('form.field-textarea', ['id' => 'pva_1', 'tag' => 'Wat wil de scholier bereiken?'])

    @include('form.field-textarea', ['id' => 'pva_2', 'tag' => 'Wat is het verwachte resultaat n.a.v. bijles bij Studied?'])

    @include('form.field-textarea', ['id' => 'pva_3', 'tag' => 'Wat is de looptijd van de doelstelling?'])

    <div class="seperator"></div>




    <div class="title">{{ __('Reality - Stand van zaken') }}</div>

    @include('form.field-textarea', ['id' => 'pva_4', 'tag' => 'Hoe ziet de situatie er nu uit? Waarom is deze problematisch?'])

    @include('form.field-textarea', ['id' => 'pva_5', 'tag' => 'Wat is reeds ondernomen? Waarom werkte dat wel of niet?'])

    @include('form.field-textarea', ['id' => 'pva_6', 'tag' => 'Hoe ziet het eruit als de problematiek niet wordt opgelost?'])

    <div class="seperator"></div>



    <div class="title">{{ __('Options - De mogelijkheden') }}</div>

    @include('form.field-textarea', ['id' => 'pva_7', 'tag' => 'De mogelijkheden van de scholier bij Studied'])

    <div class="seperator"></div>



    <div class="title">{{ __('Will - De acties') }}</div>

    @include('form.field-textarea', ['id' => 'pva_8', 'tag' => 'Worden er nog acties buiten Studied ondernomen?'])

    @include('form.field-textarea', ['id' => 'pva_9', 'tag' => 'Wat zijn mogelijke obstakels voor behalen van het gewenste resultaat? Hoe kan hier rekening mee worden gehouden?'])

    @include('form.field-textarea', ['id' => 'pva_10', 'tag' => 'Ons adviesplan', 'Placeholder' => 'Wat wordt er als concludie van het voorgaande aangeraden? (Vak - periode - frequentie)'])

    <div class="seperator"></div>



    <div id="agreements-wrap">

        @include('form.field-create-agreement', ['student' => $evaluation->getStudent, 'id' => 1])

    </div>

    <div id="button-add-agreement" class="button grey" onclick="$('#agreements-wrap').append( jQuery('<div>').load('/load/evaluation/agreement', { evaluation: '{{ $evaluation->id }}', id: $('#agreements-wrap div').length + 1 }));">Toevoegen</div>



    @include('form.field-hidden', ['id' => '_evaluation', 'value' => $evaluation->id])



@endsection
