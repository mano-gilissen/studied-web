@extends('form.template')



@section('scripts')

    <script>

        var study                       = '{{ $study->id }}';

    </script>

    <script src="{{ asset('js/form_210525.js') }}"></script>

@endsection



@section('fields')



    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('component.field-select-time', ['set_start' => $study->start, 'trigger' => 'report'])

    <div class="seperator"></div>



    @foreach($study->getAgreements as $agreement)



        @php
            $user             = $agreement->getStudent;
            $id_user          = 'user_' . $user->id . '_';
        @endphp



        @if(\App\Http\Traits\StudyTrait::hasGroupReporting($study))

            <div class="seperator"></div>

            <div class="block-note">{{ __('Dit is het rapport voor') }}&nbsp;<span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($user->getPerson) }}</span></div>

            <div class="seperator"></div>

        @endif



        <div class="title">{{ __('Wat is er behandeld?') }}</div>

        <div class="subjects" id="subjects_{{ $user->id }}" data-user="{{ $user->id }}" data-agreement="{{ $agreement->id }}"> @include('load.subjects') </div>

        <div class="seperator large"></div>



        @if(\App\Http\Traits\StudyTrait::isTrial($study))

            <div class="title">{{ __('Hoe ging de proefles?') }}</div>

            <div class="block-note" id="note-trial">{{ __('Het is belangrijk om goed aan te geven of de proefles een succes was of niet. Dit bepaalt namelijk of de vakafspraak definitief is en of de leerling les van jou blijft krijgen in dit vak. Contacteer de managing-student voordat je het rapport instuurt als je het niet zeker weet.') }}</div>

            @include('component.switch', ['id' => 'user_' . $user->id . '_trial', 'tag' => __('Is de proefles gelukt?')])

            <div class="seperator"></div>

            <script>

                $(function(){

                    set_submit_enabled(false)

                });

            </script>

        @endif



        <div class="title">{{ __('Hoe verloopt de begeleiding?') }}</div>

        @include('component.field-textarea', ['id' => $id_user . 'content_volgende_les', 'tag' => __('Wat gaan jullie volgende les doen?'), 'required' => true, 'value' => old($id_user . 'content_volgende_les')])

        @include('component.field-textarea', ['id' => $id_user . 'content_uitdagingen', 'tag' => __('Wat ging er goed?'), 'required' => true, 'value' => old($id_user . 'content_uitdagingen')])

        @include('component.field-textarea', ['id' => $id_user . 'content_voortgang', 'tag' => __('Wat kan er worden verbeterd?'), 'required' => true, 'value' => old($id_user . 'content_voortgang')])

        <div class="seperator"></div>



    @endforeach



    @include('component.field-hidden', ['id' => '_study', 'value' => $study->id])




@endsection
