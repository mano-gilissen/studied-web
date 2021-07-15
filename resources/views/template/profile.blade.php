@extends('app')



@section('css')

    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header', ['page_title' => 'Profielpagina'])

    @include('block.menu')

    <div id="wrap">

        <div style="margin: 160px 80px 80px">

            <div class="block-attributes" style="width: 324px">

                <div class="title">Gegevens</div>

                <div class="list-attributes">

                    <div class="attribute">

                        <div class="name">Naam</div>

                        <div class="value">{{ \App\Http\Traits\UserTrait::getFullName($person) }}</div>

                    </div>

                    <div class="attribute">

                        <div class="name">Rol</div>

                        <div class="value">{{ $person->getUser->getRole->label }}</div>

                    </div>

                    <div class="attribute">

                        <div class="name">Email</div>

                        <div class="value">{{ $person->getUser->email }}</div>

                    </div>

                </div>

            </div>

            <img style="width:200px;height:200px;margin-top:30px;" src="/storage/avatar/{{ $person->avatar }}"/>

        </div>

    </div>

@endsection
