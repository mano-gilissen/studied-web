@extends('template.list')



@section('actions')

    @switch(Auth::user()->role)

        @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)

        @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

        @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

            <div class="button grey icon" onclick="window.location.href='{{ route('employee.create') }}'">

                <img class="icon" src="/images/add.svg">

                <div class="text">{{ __('Aanmaken') }}</div>

            </div>

            @break

    @endswitch

@endsection
