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



    <div class="title">{{ __('Wat is er behandeld?') }}</div>

    <div id="subjects">

        @include('load.subjects')

    </div>

    <div style="height:104px"></div>



    <div class="title">{{ __('Hoe verloopt de begeleiding?') }}</div>

    @include('form.field-textarea', ['id' => 'volgende_les', 'tag' => 'Volgende les', 'required' => true])

    @include('form.field-textarea', ['id' => 'uitdagingen', 'tag' => 'Uitdagingen', 'required' => true])

    @include('form.field-textarea', ['id' => 'voortgang', 'tag' => 'Voortgang', 'required' => true])




@endsection
