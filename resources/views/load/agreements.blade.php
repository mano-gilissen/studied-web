<div class="buttons">

    <img class="button" id="button-previous" src="/images/back.svg"/>

    <img class="button" id="button-next" src="/images/forward.svg"/>

</div>

<div class="wrap">

    <div id="agreements">

        @if($user ?? false)

            @if($user->getAgreements_asEmployee->count() > 0)

                @foreach($user->getAgreements_asEmployee as $agreement)

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

                        <input
                            id                                          = "_agreement_{{ $agreement->id }}"
                            name                                        = "_agreement"
                            type                                        = "hidden">

                    </div>

                @endforeach

                <script>

                    agreements_set_active(0);

                </script>

            @else

                <div class="note">Deze Student-docent heeft geen actieve vakafspraken.</div>

            @endif

        @else

            <div class="note">Selecteer eerst een Student-docent.</div>

        @endif

    </div>

</div>
