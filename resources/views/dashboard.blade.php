@extends('app')



@section('css')

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="{{ asset('js/graph.js') }}" defer></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection



@section('content')



    @php $page_title = __('Dashboard'); @endphp

    @include('section.header')

    @include('section.menu')



    <div id="wrap">

        <div id="column">

            @if(\App\Http\Traits\UserTrait::hasDashboardTodoModules())

                @include('section.dashboard-todo')

            @endif

            @if(in_array(\App\Http\Controllers\DashboardController::MODULE_GRAPHS_STATISTICS, $modules))

                @include('section.dashboard-graphs_statistics')

            @endif

            @if(in_array(\App\Http\Controllers\DashboardController::MODULE_ANNOUNCEMENTS, $modules))

                @if(in_array(\App\Http\Controllers\DashboardController::MODULE_ANNOUNCEMENTS_SEND, $modules))

                    <div class="columns">

                        @include('section.dashboard-announcements_send')

                        @include('section.dashboard-announcements')

                    </div>

                @else

                    @include('section.dashboard-announcements')

                @endif

            @endif

        </div>

    </div>

@endsection




