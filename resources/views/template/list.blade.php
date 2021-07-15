@extends('app')



@section('css')

    <link href="{{ asset('css/list.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    @include('block.menu')

    <div id="wrap">

        <div id="content">

            <div class="top">

                <div class="actions">

                    <div id="button-filter-add" class="button icon-reverse">

                        <div class="text">{{ __('Filter') }}</div>

                        <img class="icon" src="/images/add.svg">

                    </div>

                    <div id="filters">



                    </div>

                    @yield('actions')

                </div>

                <div class="counters">

                    @foreach($counters as $counter)

                        <div class="counter" @if($loop->first) style="margin-left:0" @endif>

                            <div class="label">{{ $counter->label }}</div>

                            <div class="label">{{ $counter->value }}</div>

                        </div>

                    @endforeach

                </div>

            </div>

            <div class="list">

                <div id="headers" style="grid-template-columns: {{ $column_spacing }}">

                    @foreach($columns as $column)

                        <div class="header {{ $column->state ?? '' }}">{{ $column->label }}</div>

                    @endforeach

                </div>

                <div id="items">

                    @foreach($items as $item)

                        <div class="item @if($loop->even) even @endif" style="grid-template-columns: {{ $column_spacing }}">

                            @foreach($columns as $column)

                                <div class="attribute">

                                    <div class="{{ $column->type ?? '' }}">{{ $item->{$column->label} }}</div>

                                </div>

                            @endforeach

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endsection




