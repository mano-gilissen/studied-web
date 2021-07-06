@extends('app')



@section('css')

    <link href="{{ asset('css/study.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header')

    <div id="wrap">

        <div id="banner" style="background-image:url({{url('images/study_banner_example.png')}})">

            <div class="title">{{ $study->getSubject_Defined ? $study->getSubject_Defined->description_short : $study->subject_text }}</div>

        </div>

        <div id="actions">

            @if($button_contact_host ?? false)

                <div class="button icon">

                    <img class="icon" src="/images/contact.svg">

                    <div class="text">Contacteer {{ $study->getHost->getPerson->first_name }}</div>

                </div>

            @endif

        </div>

        <div id="content">

            <div class="content-columns">

                <div class="column left">

                    @switch($study->service)

                        @case(\App\Http\Traits\ServiceTrait::$ID_PRIVELES)

                            @include('block.study-host-priveles')

                            @include('block.study-details')

                        @break

                        @case(\App\Http\Traits\ServiceTrait::$ID_GROEPSLES)

                            @include('block.study-details')

                            @include('block.study-location')

                        @break

                        @case(\App\Http\Traits\ServiceTrait::$ID_COLLEGE)

                            @include('block.study-details')

                            @include('block.study-location')

                    @endswitch

                </div>

                <div class="column right">

                    @switch($study->service)

                        @case(\App\Http\Traits\ServiceTrait::$ID_PRIVELES)

                            @include('block.study-participants-priveles')

                            @include('block.study-location')

                        @break

                        @case(\App\Http\Traits\ServiceTrait::$ID_GROEPSLES)

                            @include('block.study-host-groepsles')

                            @include('block.study-participants-groepsles')

                        @break

                        @case(\App\Http\Traits\ServiceTrait::$ID_COLLEGE)

                            @include('block.study-host-college')

                            @include('block.study-participants-college')

                    @endswitch

                </div>

            </div>

        </div>

    </div>

@endsection
