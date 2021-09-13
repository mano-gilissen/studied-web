@extends('app')



@section('css')

    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection



@section('scripts')

    <script src="{{ asset('js/profile.js') }}"></script>

@endsection



@section('content')

    @include('block.header')

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

                        <div class="comment">"{{ $comment }}"</div>

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

                                @if($person->getUser->{\App\Http\Support\Model::$USER_STATUS} == \App\Http\Traits\UserTrait::$STATUS_INTAKE)

                                    <div class="button green icon" onclick="window.location.href='{{ route('person.activate', [\App\Http\Support\Model::$PERSON_SLUG => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}'">

                                        <img class="icon" src="/images_app/contact-white.svg">

                                        <div class="text">Activeren</div>

                                    </div>

                                @endif

                                <div class="button grey icon" onclick="window.location.href='{{ route('study.list', [\App\Http\Controllers\StudyController::$PARAMETER_HOST => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}'">

                                    <img class="icon" src="/images_app/search.svg">

                                    <div class="text">Lessen</div>

                                </div>

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                @if($person->getUser->id == Auth::id())

                                    <div class="button grey icon" onclick="window.location.href='{{ route('study.list') }}'">

                                        <img class="icon" src="/images_app/search.svg">

                                        <div class="text">Lessen</div>

                                    </div>

                                @else

                                    @if(strlen($person->{\App\Http\Support\Model::$PERSON_SOCIAL_INSTAGRAM}) > 0)

                                        <div class="button grey icon" onclick="window.location.href='{{ 'https://instagram.com/' . $person->{\App\Http\Support\Model::$PERSON_SOCIAL_INSTAGRAM} }}'">

                                            <img class="icon" src="/images_app/social-instagram.svg">

                                            <div class="text">Instagram</div>

                                        </div>

                                    @endif

                                    @if(strlen($person->{\App\Http\Support\Model::$PERSON_SOCIAL_LINKEDIN}) > 0)

                                        <div class="button grey icon" onclick="window.location.href='{{ 'https://www.linkedin.com/in/' . $person->{\App\Http\Support\Model::$PERSON_SOCIAL_LINKEDIN} }}'">

                                            <img class="icon" src="/images_app/social-linkedin.svg">

                                            <div class="text">LinkedIn</div>

                                        </div>

                                    @endif

                                @endif

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if(strlen($person->{\App\Http\Support\Model::$PERSON_SOCIAL_INSTAGRAM}) > 0)

                                    <div class="button grey icon" onclick="window.location.href='{{ 'https://instagram.com/' . $person->{\App\Http\Support\Model::$PERSON_SOCIAL_INSTAGRAM} }}'">

                                        <img class="icon" src="/images_app/social-instagram.svg">

                                        <div class="text">Instagram</div>

                                    </div>

                                @endif

                                @if(strlen($person->{\App\Http\Support\Model::$PERSON_SOCIAL_LINKEDIN}) > 0)

                                    <div class="button grey icon" onclick="window.location.href='{{ $person->{\App\Http\Support\Model::$PERSON_SOCIAL_LINKEDIN} }}'">

                                        <img class="icon" src="/images_app/social-linkedin.svg">

                                        <div class="text">LinkedIn</div>

                                    </div>

                                @endif

                                @break

                        @endswitch

                        @break

                    @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                        @switch(Auth::user()->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                <div class="button grey icon" onclick="window.location.href='{{ route('study.list', [\App\Http\Controllers\StudyController::$PARAMETER_PARTICIPANT => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}'">

                                    <img class="icon" src="/images_app/search.svg">

                                    <div class="text">Lessen</div>

                                </div>

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @if($person->getUser->id == Auth::id())

                                    <div class="button grey icon" onclick="window.location.href='{{ route('study.list') }}'">

                                        <img class="icon" src="/images_app/search.svg">

                                        <div class="text">Lessen</div>

                                    </div>

                                @endif

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if(Auth::user()->getCustomer->isStudent($person->getUser->getStudent))

                                    <div class="button grey icon" onclick="window.location.href='{{ route('study.list', [\App\Http\Controllers\StudyController::$PARAMETER_PARTICIPANT => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}'">

                                        <img class="icon" src="/images_app/search.svg">

                                        <div class="text">Lessen</div>

                                    </div>

                                @endif

                                @break

                        @endswitch

                        @break

                    @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                        @switch(Auth::user()->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                <div id="button-studies" class="button grey icon" onclick="window.location.href='{{ route('study.list', [\App\Http\Controllers\StudyController::$PARAMETER_CUSTOMER => $person->{\App\Http\Support\Model::$PERSON_SLUG}]) }}'">

                                    <img class="icon" src="/images_app/search.svg">

                                    <div class="text">Lessen</div>

                                </div>

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if($person->getUser->id == Auth::id())

                                    <div id="button-studies" class="button grey icon" onclick="window.location.href='{{ route('study.list') }}'">

                                        <img class="icon" src="/images_app/search.svg">

                                        <div class="text">Lessen</div>

                                    </div>

                                @endif

                                @break

                            @endswitch

                @endswitch

                @if(\App\Http\Traits\BaseTrait::hasManagementRights())

                    @if($person->getUser->id == Auth::id())

                        <div class="button icon grey" onclick="window.location.href='{{ route('user.edit') }}'">

                            <img class="icon" src="/images_app/edit.svg">

                            <div class="text">Foto- en wachtwoord wijzigen</div>

                        </div>

                    @endif

                    @if(\App\Http\Traits\BaseTrait::hasBoardRights() || $person->getUser->role != \App\Http\Traits\RoleTrait::$ID_BOARD)

                        <div class="button icon" onclick="window.location.href='{{ route('person.edit', $person->{\App\Http\Support\Model::$PERSON_SLUG}) }}'">

                            <img class="icon" src="/images_app/edit.svg">

                            <div class="text">Bewerken</div>

                        </div>

                    @endif

                @elseif($person->getUser->id == Auth::id())

                    <div class="button icon" onclick="window.location.href='{{ route('user.edit') }}'">

                        <img class="icon" src="/images_app/edit.svg">

                        <div class="text">Bewerken</div>

                    </div>

                @else

                    @include('block.contact-popout', ['tag' => 'Contacteer', 'user' => $person->getUser])

                @endif

            </div>

            <div id="content">

                <div class="content-columns">

                    <div class="column left">

                        @include('block.profile-about')

                    </div>

                    <div class="column right">

                        @switch($person->getUser->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                @include('block.profile-students-of-employee')

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @include('block.profile-connections')

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @include('block.profile-students-of-customer')

                                @break

                        @endswitch

                    </div>

                </div>

                <div class="wide">

                    @switch($person->getUser->role)

                        @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                        @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                        @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                        @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                            @include('block.profile-agreements')

                            @break

                        @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                            @include('block.profile-agreements')

                            @include('block.profile-evaluations')

                            @break

                        @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                            @include('block.profile-evaluations')

                            @break

                    @endswitch

                </div>

                <div style="height: 64px"></div>

                <div class="content-columns">

                    <div class="column left">

                        @switch(\App\Http\Traits\BaseTrait::getUserRole())

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                            @include('block.profile-contact-personal')

                            @break

                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                            @switch($person->getUser->role)

                                @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                                @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                                @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                                @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                @include('block.profile-contact-personal')

                                @break

                                @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @foreach($person->getUser->getEmployees as $employee)

                                    @if($employee->id == Auth::user()->id)

                                        @include('block.profile-contact-personal')

                                        @break

                                    @endif

                                @endforeach

                                @break

                                @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @foreach(Auth::user()->getStudents as $student)

                                    @if($student->customer == $person->getUser->getCustomer->id)

                                        @include('block.profile-contact-personal')

                                        @break

                                    @endif

                                @endforeach

                                @break

                            @endswitch

                            @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                            @switch($person->getUser->role)

                                @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                                @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                                @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                                @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                @foreach($person->getUser->getStudents as $student)

                                    @if($student->id == Auth::user()->id)

                                        @include('block.profile-contact-personal')

                                        @break

                                    @endif

                                @endforeach

                                @break

                                @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @if($person->getUser->id == Auth::user()->id)

                                    @include('block.profile-contact-personal')

                                @endif

                                @break

                                @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if(Auth::user()->getStudent->customer == $person->getUser->getCustomer->id)

                                    @include('block.profile-contact-personal')

                                @endif

                                @break

                            @endswitch

                            @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                            @switch($person->getUser->role)

                                @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                                @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                                @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                                @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                @foreach($person->getUser->getStudents as $student)

                                    @if($student->getStudent->customer == Auth::user()->getCustomer->id)

                                        @include('block.profile-contact-personal')

                                        @break

                                    @endif

                                @endforeach

                                @break

                                @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @if($person->getUser->getStudent->customer == Auth::user()->getCustomer->id)

                                    @include('block.profile-contact-personal')

                                @endif

                                @break

                                @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if($person->getUser->id == Auth::user()->id)

                                    @include('block.profile-contact-personal')

                                @endif

                                @break

                            @endswitch

                            @break

                        @endswitch <!-- PROFILE-CONTACT-PERSONAL -->

                        @switch($person->getUser->role)

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)

                            @if(\App\Http\Traits\BaseTrait::hasBoardRights())

                                @include('block.profile-dienstbetrekking')

                            @endif

                            @break

                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                            @if(\App\Http\Traits\BaseTrait::hasManagementRights())

                                @include('block.profile-dienstbetrekking')

                            @endif

                            @break
                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                            @if(\App\Http\Traits\BaseTrait::hasManagementRights() || $person->getUser->id == Auth::user()->id)

                                @include('block.profile-dienstbetrekking')

                            @endif

                            @break

                        @endswitch <!-- DIENSTBETREKKING -->

                    </div>

                    <div class="column right">

                        @if($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_STUDENT)

                        @switch(\App\Http\Traits\BaseTrait::getUserRole())

                            @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                            @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                            @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)

                                @include('block.profile-education')

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                                @foreach($person->getUser->getEmployees as $employee)

                                    @if($employee->id == Auth::user()->id)

                                        @include('block.profile-education')

                                        @break

                                    @endif

                                @endforeach

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_STUDENT)

                                @include('block.profile-education')

                                @break

                            @case(\App\Http\Traits\RoleTrait::$ID_CUSTOMER)

                                @if($person->getUser->getStudent->customer == Auth::user()->getCustomer->id)

                                    @include('block.profile-education')

                                    @break

                                @endif

                                @break

                        @endswitch

                    @endif <!-- PROFILE-EDUCATION -->

                        @switch($person->getUser->role)

                        @case(\App\Http\Traits\RoleTrait::$ID_ADMINISTRATOR)
                        @case(\App\Http\Traits\RoleTrait::$ID_BOARD)
                        @case(\App\Http\Traits\RoleTrait::$ID_MANAGEMENT)
                        @case(\App\Http\Traits\RoleTrait::$ID_EMPLOYEE)

                        @include('block.profile-loopbaan')

                        @break

                    @endswitch <!-- LOOPBAAN -->

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
