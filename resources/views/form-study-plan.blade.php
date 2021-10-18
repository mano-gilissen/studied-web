@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => 'Datum', 'placeholder' => 'Kies een datum', 'required' => true, 'trigger' => 'agreements'])

    @include('form.field-select-time')

    @include('form.field-input', ['id' => 'location', 'tag' => 'Locatie', 'icon' => 'search.svg', 'placeholder' => 'Zoek een locatie', 'required' => true, 'data' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

    @include('form.field-input', ['id' => 'link', 'tag' => 'Digitale les', 'icon' => 'url.svg', 'placeholder' => 'Plak een URL'])

    <div class="seperator"></div>



    @if(Auth::user()->role == \App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

        <div class="title">{{ __('Activiteit(en)') }}</div>

        @foreach($errors->getMessages() as $key => $message)

            @if(\App\Http\Support\Func::contains($key, \App\Http\Support\Model::$AGREEMENT))

                <div class="block-note error" style="margin-bottom: 24px">>De vakafspraak moet op de datum van de les actief zijn.</div>

            @endif

        @endforeach

        @include('form.field-hidden', ['id' => '_host', 'value' => Auth::id()])

        @include('form.field-select-agreement', ['host' => Auth::user()])

    @else

        <div class="title">{{ __('Medewerker') }}</div>

        @include('form.field-input', ['id' => 'host', 'tag' => 'Student-docent', 'icon' => 'search.svg', 'placeholder' => 'Zoek een medewerker', 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'trigger' => 'agreements'])

        <div class="seperator"></div>



        <div class="title">{{ __('Activiteit(en)') }}</div>

        @foreach($errors->getMessages() as $key => $message)

            @if(\App\Http\Support\Func::contains($key, \App\Http\Support\Model::$AGREEMENT))

                <div class="block-note error" style="margin-bottom: 24px">De vakafspraak moet op de datum van de les nog actief zijn.</div>

            @endif

        @endforeach

        @include('form.field-select-agreement')

    @endisset

    <div class="seperator"></div>



    <div class="title">{{ __('Details') }}</div>

    @include('form.field-input', ['id' => 'remark', 'tag' => 'Opmerking'])



    <script>

        $(function(){

            set_submit_enabled(false)

        });

    </script>



@endsection
