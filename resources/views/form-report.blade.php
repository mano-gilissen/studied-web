@extends('template.form')



@section('scripts')

    <script>

        var study                       = '{{ $study->id }}';

    </script>

@endsection



@section('fields')



    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('form.field-select-time', ['set_study' => true, 'trigger' => 'report'])

    <div class="seperator"></div>



    <div class="title">{{ __('Wat is er behandeld?') }}</div>

    <div id="subjects">

        @include('load.subjects')

    </div>


@endsection
