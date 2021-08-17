@extends('template.form')



@section('scripts')

    <script>

        var study                       = '{{ $study->id }}';

    </script>

    <script src="{{ asset('js/form.js') }}"></script>

@endsection



@section('fields')

    <div class="title">{{ __('Dit rapport is voor:') }}</div>

    @include('block.person', ['person' => $user->getPerson])

    <div class="seperator"></div>



    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>



    @include('form.field-select-time', ['set_study' => true, 'trigger' => 'report'])

    <div class="seperator"></div>



    <div class="title">{{ __('Wat is er behandeld?') }}</div>

    <div id="subjects"> @include('load.subjects') </div>

    <div class="seperator large"></div>



    <div class="title">{{ __('Hoe verloopt de begeleiding?') }}</div>

    @include('form.field-textarea', ['id' => 'content_volgende_les', 'tag' => 'Volgende les', 'required' => true])

    @include('form.field-textarea', ['id' => 'content_uitdagingen', 'tag' => 'Uitdagingen', 'required' => true])

    @include('form.field-textarea', ['id' => 'content_voortgang', 'tag' => 'Voortgang', 'required' => true])



    @include('form.field-hidden', ['id' => '_user', 'value' => $user->id])

    @include('form.field-hidden', ['id' => '_study', 'value' => $study->id])




@endsection
