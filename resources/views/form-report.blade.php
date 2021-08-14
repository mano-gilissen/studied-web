@extends('template.form')



@section('fields')

    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('form.field-select-time')

    <div class="seperator"></div>



    <div class="title">{{ __('Wat is er behandeld?') }}</div>

    @include('form.field-report-subject', ['id' => 1, 'time_available' => 75, 'primary' => true])

    <div class="seperator"></div>

    @include('form.field-report-subject', ['id' => 2, 'time_available' => 75, 'primary' => false])


@endsection
