@extends('template.form')



@section('scripts')

    <script>

        var study                       = '{{ $study->id }}';

    </script>

    <script src="{{ asset('js/form.js') }}"></script>

@endsection



@section('fields')



    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('form.field-select-time', ['set_study' => true, 'trigger' => 'report'])

    <div class="seperator"></div>



    @foreach($study->getAgreements as $agreement)



        @php
            $user             = $agreement->getStudent;
            $id_user          = 'user_' . $user->id . '_';
        @endphp



        @if(\App\Http\Traits\StudyTrait::hasGroupReporting($study))

            <div class="seperator"></div>

            <div class="block-note">Dit is het rapport voor <span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($user->getPerson) }}</span></div>

            <div class="seperator"></div>

        @endif



        <div class="title">{{ __('Wat is er behandeld?') }}</div>

        <div class="subjects" id="subjects_{{ $user->id }}" data-user="{{ $user->id }}" data-agreement="{{ $agreement->id }}"> @include('load.subjects') </div>

        <div class="seperator large"></div>



        @if(\App\Http\Traits\StudyTrait::isTrial($study))

            <div class="seperator"></div>

            <div class="field">

                <div class="name">Is de proefles gelukt?</div>

                <div class="switch">

                    <div class="button transparent" data-value="1">Ja</div>

                    <div class="button transparent last" data-value="0">Nee</div>

                    @include('form.field-hidden', ['id' => '_trial_' . $user->id])

                </div>

            </div>

            <div class="seperator"></div>

        @endif



        <div class="title">{{ __('Hoe verloopt de begeleiding?') }}</div>

        @include('form.field-textarea', ['id' => $id_user . 'content_volgende_les', 'tag' => 'Volgende les', 'required' => true])

        @include('form.field-textarea', ['id' => $id_user . 'content_uitdagingen', 'tag' => 'Uitdagingen', 'required' => true])

        @include('form.field-textarea', ['id' => $id_user . 'content_voortgang', 'tag' => 'Voortgang', 'required' => true])

        <div class="seperator"></div>



    @endforeach



    @include('form.field-hidden', ['id' => '_study', 'value' => $study->id])




@endsection
