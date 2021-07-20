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

                    <div id="button-filter-add" class="button icon">

                        <img class="icon" src="/images/add-white.svg">

                        <div class="text">{{ __('Filter') }}</div>

                    </div>

                    <div id="filters" style="width: 100px;background:green">



                    </div>

                    @yield('actions')

                </div>

                <div class="counters">

                    @foreach($counters as $counter)

                        <div class="counter" @if($loop->first) style="margin-left:0" @endif>

                            <div class="label">{{ $counter->label }}</div>

                            <div class="value">{{ $counter->value }}</div>

                        </div>

                    @endforeach

                </div>

            </div>

            <div class="list">

                <div id="headers" style="grid-template-columns: {{ $column_spacing }}">

                    @foreach($columns as $column)

                        <div class="header {{ $column->state ?? '' }}">{{ $column->label }}</div>

                    @endforeach

                    <div></div>

                </div>

                <div id="items">

                    @foreach($items as $item)

                        <div class="item @if($loop->odd) odd @endif" style="grid-template-columns: {{ $column_spacing }}" onclick="window.location.href='{{ $item->link ?? '' }}'">

                            @foreach($columns as $column)

                                <div class="attribute">

                                    <div>@if($column->html){!! $item->{$column->id} !!}@else{{ $item->{$column->id} }}@endif</div>

                                </div>

                            @endforeach

                            <img class="action" src="{{ $action ?? '/images/chevron-right.svg' }}"/>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

@endsection




