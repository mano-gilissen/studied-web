@extends('app')



@section('css')

    <link href="{{ asset('css/list.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script>

        var data_type                       = '{{ $data_type }}';

        data_sort                           = JSON.parse('{!! $data_sort !!}');
        data_filter                         = JSON.parse('{!! $data_filter !!}');

    </script>

    <script src="{{ asset('js/list.js') }}"></script>

@endsection



@section('content')

    @include('block.header')

    @include('block.menu')

    <div id="wrap">

        <div id="content">

            <div class="top">

                <div id="actions">

                    <div id="button-filter-add" class="button icon">

                        <img class="icon" src="/images/add-white.svg">

                        <div class="text">{{ __('Filter') }}</div>

                    </div>

                    <div id="filters">



                    </div>

                    @yield('actions')

                </div>

                <div id="counters">

                    @foreach($counters as $counter)

                        <div class="counter" @if($loop->first) style="margin-left:0" @endif>

                            <div class="label">{{ $counter->label }}</div>

                            <div class="value">{{ $counter->value }}</div>

                        </div>

                    @endforeach

                </div>

            </div>

            <div id="list">

            </div>

        </div>

    </div>

@endsection




