@extends('template.list')



@section('actions')

    <div class="button grey icon" onclick="window.location.href='{{ route('study.form') }}'">

        <img class="icon" src="/images/add.svg">

        <div class="text">{{ __('Inplannen') }}</div>

    </div>

@endsection
