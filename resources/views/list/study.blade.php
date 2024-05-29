@extends('template.list')



@section('actions')

    {{ Illuminate\Support\Facades\App::getLocale() }}

    @switch(Auth::user()->role)

        @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

        @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

        @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

        @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

            <div class="button grey icon" onclick="window.location.href='{{ route('study.plan') }}'">

                <img class="icon" src="/images_app/add.svg">

                <div class="text">{{ __('Inplannen') }}</div>

            </div>

            @break

    @endswitch

    @switch(Auth::user()->role)

        @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

        @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

        @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

            <div class="button grey icon" onclick="csv('lessen', 'data')">

                <img class="icon" src="/images_app/fix.svg">

                <div class="text">{{ __('Data exporteren') }}</div>

            </div>

            <div class="button grey icon" onclick="csv('lessen', 'overview')">

                <img class="icon" src="/images_app/fix.svg">

                <div class="text">{{ __('Urenoverzicht') }}</div>

            </div>

            @break

    @endswitch

@endsection
