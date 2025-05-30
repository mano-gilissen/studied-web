@extends('list.template')



@section('actions')

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

            <div class="button grey icon" onclick="csv('lessen')">

                <img class="icon" src="/images_app/fix.svg">

                <div class="text">{{ __('Data exporteren') }}</div>

            </div>

            @break

    @endswitch

@endsection
