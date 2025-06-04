@extends('app')



@section('css')

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="{{ asset('js/graph.js') }}" defer></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/currency.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection



@section('content')



    @php $page_title = __('Dashboard'); @endphp

    @include('section.header')

    @include('section.menu')



    <div id="wrap">

        <div id="column">

            <div id="left">

                @if(in_array(\App\Http\Controllers\DashboardController::MODULE_TODO, $modules))

                    @include('section.dashboard-todo')

                @endif

                @if(in_array(\App\Http\Controllers\DaschboardController::MODULE_GRAPHS_STATISTICS, $modules))

                    @include('section.dashboard-graphs_statistics')

                @endif

            </div>

            <div id="right">

                @if(in_array(\App\Http\Controllers\DashboardController::MODULE_ANNOUNCEMENTS, $modules))

                    @include('section.dashboard-announcements')

                @endif

            </div>

        </div>

    </div>

@endsection




