@extends('template.form')



@section('fields')

    <div class="title">{{ __('Hoe lang duurde de les precies?') }}</div>

    @include('form.field-select-time')

    <div class="seperator"></div>



    <div class="title">{{ __('Wat is er behandeld?') }}</div>

    @include('form.field-report-subject', ['id' => 'primary', 'available' => 75, 'locked' => false3])



@endsection
