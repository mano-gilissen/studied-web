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

                <div id="avatar">

                    <div></div>

                    <div>

                        @if($person->avatar)

                            <img src="{{ asset("storage/avatar/" . $person->avatar) }}"/>

                        @else

                            <div>

                                <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($person) }}</div>

                            </div>

                        @endif

                    </div>

                    <div id="comment">

                        <div class="comment-tail"></div>

                        <div class="comment">{{ $comment }}</div>

                    </div>

                </div>

                <div class="name">{{ \App\Http\Traits\PersonTrait::getFullName($person) }}</div>

                <div class="role">{{ \App\Http\Traits\UserTrait::getRoleName($person->getUser, true) }}</div>

            </div>

            <div id="actions">

                @switch($person->getUser->role)

                    @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                    @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                    @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                    @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                        @switch(Auth::user()->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                <div class="button grey icon" onclick="window.location.href='{{ route('study.list', ['host' => $person->getUser->id]) }}'">

                                    <img class="icon" src="/images/search.svg">

                                    <div class="text">Lessen</div>

                                </div>

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                <div class="button grey icon" onclick="window.location.href='{{ 'https://instagram.com/' . $person->social_instagram }}'">

                                    <img class="icon" src="/images/social-instagram.svg">

                                    <div class="text">Instagram</div>

                                </div>

                                @break

                        @endswitch

                        @break

                    @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                        @switch(Auth::user()->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                <div class="button grey icon" onclick="window.location.href='{{ route('study.list', ['participant' => $person->getUser->id]) }}'">

                                    <img class="icon" src="/images/search.svg">

                                    <div class="text">Lessen</div>

                                </div>

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @if($person->getUser->id == Auth::user()->id)

                                    <div class="button grey icon" onclick="window.location.href='{{ route('study.list', ['participant' => $person->getUser->id]) }}'">

                                        <img class="icon" src="/images/search.svg">

                                        <div class="text">Lessen</div>

                                    </div>

                                @endif

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                <!-- TODO: ADD IF $PERSON IS CUSTOMER_STUDENT OF AUTH -->

                                @break;

                        @endswitch

                        @break

                    @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                        @switch(Auth::user()->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                <div id="button-studies" class="button grey icon" onclick="window.location.href='{{ route('study.list', ['customer' => $person->getUser->id]) }}'">

                                    <img class="icon" src="/images/search.svg">

                                    <div class="text">Lessen</div>

                                </div>

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if($person->getUser->id == Auth::user()->id)

                                    <div id="button-studies" class="button grey icon" onclick="window.location.href='{{ route('study.list', ['customer' => $person->getUser->id]) }}'">

                                        <img class="icon" src="/images/search.svg">

                                        <div class="text">Lessen</div>

                                    </div>

                                @endif

                                @break

                            @endswitch

                @endswitch

                <div class="button icon">

                    <img class="icon" src="/images/contact.svg">

                    <div class="text">Contacteer</div>

                </div>

            </div>

            <div id="content">

                <div class="content-columns">

                    <div class="column left">

                        @include('block.profile-about')

                    </div>

                    <div class="column right">



                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
