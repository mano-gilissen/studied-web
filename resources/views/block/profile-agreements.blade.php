<div class="agreements">

    <div class="buttons">

        <img class="button" id="button-previous" src="/images/back.svg"/>

        <img class="button" id="button-next" src="/images/forward.svg"/>

    </div>

    <div class="wrap">

        <div id="agreements">

            <!-- TODO: ONLY SHOW ACTIVE AGREEMENTS -->

            @php $agreements = ($person->getUser->role == \App\Http\Traits\RoleTrait::$ID_STUDENT ? $person->getUser->getAgreements_asStudent : $person->getUser->getAgreements_asEmployee) @endphp

            @if($agreements->count() > 0)

                @foreach($agreements as $agreement)

                    <div class="agreement" id="{{ $agreement->id }}" data-subject="{{ $agreement->subject }}">

                        <div class="top">

                            <div class="title">{{ $agreement->identifier }}</div>

                            <img class="selector" src="/images/check-white.svg"/>

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

                <script>

                    profile_agreements_set_active(0);

                </script>

            @else

                <div class="block-note">{{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }} heeft geen actieve vakafspraken.</div>

            @endif

        </div>

    </div>

</div>
