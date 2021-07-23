@extends('app')



@section('css')

    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection



@section('content')

    @include('block.header', ['page_title' => 'Profielpagina'])

    @include('block.menu')

    <div id="wrap">

        <div id="column">

            <div id="top">

                <div></div>

                <div id="avatar">

                    @if($person->avatar)

                        <img src="{{ asset("storage/avatar/" . $person->avatar) }}"/>

                    @else

                        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($person) }}</div>

                    @endif

                </div>

                <div id="comment">

                    <div class="comment-tail"></div>

                    <div class="comment">{{ $comment }}</div>

                </div>

            </div>

        </div>

    </div>

@endsection
