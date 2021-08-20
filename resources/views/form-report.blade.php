@extends('template.form')



@section('scripts')

    <script>

        var study                       = '{{ $study->id }}';

    </script>

    <script src="{{ asset('js/form.js') }}"></script>

@endsection



@section('fields')



    @if($errors->any())

        <div class="block-note error">Vul de juiste gegevens in en probeer het opnieuw.</div>

        <div class="seperator"></div>

    @endif



    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('form.field-select-time', ['set_study' => true, 'trigger' => 'report'])

    <div class="seperator"></div>



    @foreach($study->getParticipants_User as $user)



        @php $id_user = 'user_' . $user->id . '_'; @endphp



        @if(\App\Http\Traits\StudyTrait::hasGroupReporting($study))

            <div class="seperator"></div>

            <div class="block-note">Dit het rapport voor <span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($user->getPerson) }}</span></div>

            <div class="seperator"></div>

        @endif



        <div class="title">{{ __('Wat is er behandeld?') }}</div>

        <div class="subjects" id="subjects_{{ $user->id }}" data-user="{{ $user->id }}"> @include('load.subjects') </div>

        <div class="seperator large"></div>



        <div class="title">{{ __('Hoe verloopt de begeleiding?') }}</div>

        @include('form.field-textarea', ['id' => $id_user . 'content_volgende_les', 'tag' => 'Volgende les', 'required' => true])

        @include('form.field-textarea', ['id' => $id_user . 'content_uitdagingen', 'tag' => 'Uitdagingen', 'required' => true])

        @include('form.field-textarea', ['id' => $id_user . 'content_voortgang', 'tag' => 'Voortgang', 'required' => true])

        <div class="seperator"></div>



    @endforeach



    @include('form.field-hidden', ['id' => '_study', 'value' => $study->id])




@endsection
