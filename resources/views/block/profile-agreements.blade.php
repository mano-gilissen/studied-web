<div class="agreements">

    @if(\App\Http\Traits\BaseTrait::hasManagementRights(Auth::user()) && ($person->getUser->isStudent() || $person->getUser->isEmployee()))

        <div class="title-add">

            <img class="button-add" src="/images_app/add-unboxed.svg" onclick="window.location.href='{{ route('agreement.create', ['leerling' => $person->slug]) }}'">

            <div class="title">Vakafspraken</div>

        </div>

    @else

        <div class="title">Vakafspraken</div>

    @endif

    <div style="display: flex; align-items: center">

        <img class="button" id="button-previous" src="/images_app/back.svg"/>

        <div class="wrap">

            <div id="agreements">

                @php $agreements = \App\Http\Traits\UserTrait::getAgreements($person->getUser, true) @endphp

                @if($agreements->count() > 0)

                    @foreach($agreements as $agreement)

                        <div class="agreement" id="{{ $agreement->id }}" data-subject="{{ $agreement->subject }}" onclick="window.location.href='{{ route('agreement.view', ['identifier' => $agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}]) }}'">

                            <div class="top">

                                <div class="title">{{ $agreement->identifier }}</div>

                            </div>

                            <div class="bottom">

                                @php $forHost = $person->getUser->role != \App\Http\Traits\RoleTrait::$ID_STUDENT @endphp

                                @if($forHost ? $agreement->getStudent->getPerson->avatar : $agreement->getEmployee->getPerson->avatar)

                                    <img src="{{ asset("storage/avatar/" . ($forHost ? $agreement->getStudent->getPerson->avatar : $agreement->getEmployee->getPerson->avatar)) }}"/>

                                @else

                                    <div>

                                        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($forHost ? $agreement->getStudent->getPerson : $agreement->getEmployee->getPerson) }}</div>

                                    </div>

                                @endif

                                <div>{!! \App\Http\Traits\AgreementTrait::getDescription($agreement, $forHost) !!} @if($agreement->{\App\Http\Support\Model::$AGREEMENT_STATUS} == \App\Http\Traits\AgreementTrait::$STATUS_UNAPPROVED) <span class="trial"> (Proefles)</span> @endif</div>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="block-note">{{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }} heeft geen actieve vakafspraken.</div>

                @endif

            </div>

        </div>

        <img class="button" id="button-next" src="/images_app/forward.svg"/>

    </div>

</div>
