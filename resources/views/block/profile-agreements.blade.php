<div class="agreements">

    @if(\App\Http\Traits\BaseTrait::hasManagementRights(Auth::user()) && ($person->getUser->isStudent() || $person->getUser->isEmployee()))

        <div class="title-add">

            <img class="button-add" src="/images/add-unboxed.svg" onclick="window.location.href='{{ route('evaluation.plan', ['leerling' => $person->slug]) }}'">

            <div class="title">Vakafspraken</div>

        </div>

    @else

        <div class="title">Vakafspraken</div>

    @endif

    <div style="display: flex; align-items: center">

        <img class="button" id="button-previous" src="/images/back.svg"/>

        <div class="wrap">

            <div id="agreements">

                <!-- TODO: ONLY SHOW ACTIVE AGREEMENTS -->

                @php $agreements = ($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_STUDENT ? $person->getUser->getAgreements_asStudent : $person->getUser->getAgreements_asEmployee) @endphp

                @if($agreements->count() > 0)

                    @foreach($agreements as $agreement)

                        <div class="agreement" id="{{ $agreement->id }}" data-subject="{{ $agreement->subject }}">

                            <div class="top">

                                <div class="title">{{ $agreement->identifier }}</div>

                                <div class="view">Bekijken</div>

                            </div>

                            <div class="bottom">

                                @if($agreement->getStudent->getPerson->avatar)

                                    <img src="{{ asset("storage/avatar/" . $agreement->getStudent->getPerson->avatar) }}"/>

                                @else

                                    <div>

                                        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($agreement->getStudent->getPerson) }}</div>

                                    </div>

                                @endif

                                <div>{!! \App\Http\Traits\AgreementTrait::getDescription($agreement, true) !!}</div>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="block-note">{{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }} heeft geen actieve vakafspraken.</div>

                @endif

            </div>

        </div>

        <img class="button" id="button-next" src="/images/forward.svg"/>

    </div>

</div>
