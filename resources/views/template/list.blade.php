@extends('app')



@section('css')

    <link href="{{ asset('css/list_210525.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script>

        var data_type                       = '{{ $data_type }}';
        var data_sort                       = {};
        var data_search                     = '';
        var data_filter                     = JSON.parse('{!! $data_filter !!}');

    </script>

    <script src="{{ asset('js/list_210525.js') }}"></script>

@endsection



@section('content')

    @include('block.header')

    @include('block.menu')

    <div id="wrap">

        <div id="content">

            <div class="top">

                <div id="actions">

                    <div id="button-filter-add" class="button icon">

                        <img class="icon" src="/images_app/add-white.svg">

                        <div class="text">{{ __('Filter') }}</div>

                    </div>

                    <div id="filters">

                    </div>

                    @yield('actions')

                    <div id="loader-list" style="margin: 2px 0 2px 16px; display: none">

                        <div class="loader"></div>

                    </div>

                </div>

                @if(\App\Http\Traits\BaseTrait::hasManagementRights(Auth::user()))

                    @include('form.box-input', ['id' => 'input-filter-search', 'placeholder' => __('Zoeken..'), 'icon' => 'search.svg', 'id_outer' => 'search-wrap'])

                @endif

                <div id="counters">



                </div>

            </div>

            <div id="list">

            </div>

        </div>

    </div>

@endsection




