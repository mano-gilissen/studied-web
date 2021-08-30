<div class="buttons">

    <img class="button" id="button-previous" src="/images_app/back.svg"/>

    <img class="button" id="button-next" src="/images_app/forward.svg"/>

</div>

<div class="wrap">

    <div id="agreements">

        @if($user ?? false)

            @php $agreements = \App\Http\Traits\UserTrait::getAgreements($user, true); @endphp

            @if($agreements->count() > 0)

                @foreach($agreements as $agreement)

                    <div class="agreement" id="{{ $agreement->id }}" data-subject="{{ $agreement->subject }}">

                        <div class="top">

                            <div class="title">{{ $agreement->identifier }}</div>

                            <img class="selector" src="/images_app/check-white.svg"/>

                        </div>

                        <div class="bottom">

                            @if($agreement->getStudent->getPerson->avatar)

                                <img src="{{ asset("storage/avatar/" . $agreement->getStudent->getPerson->avatar) }}"/>

                            @else

                                <div>

                                    <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($agreement->getStudent->getPerson) }}</div>

                                </div>

                            @endif

                            <div>{!! \App\Http\Traits\AgreementTrait::getDescription($agreement, true) !!} @if(\App\Http\Traits\AgreementTrait::isNowTrail($agreement)) <span class="trial"> (Proefles)</span> @endif</div>

                        </div>

                        <input
                            id                                          = "_agreement_{{ $agreement->id }}"
                            name                                        = "_agreement_{{ $agreement->id }}"
                            type                                        = "hidden">

                    </div>

                @endforeach

                <script>

                    study_agreements_set_active(0);

                </script>

            @else

                <div class="block-note">Deze Student-docent heeft geen actieve vakafspraken.</div>

            @endif

        @else

            <div class="block-note">Selecteer eerst een Student-docent.</div>

        @endif

    </div>

</div>
