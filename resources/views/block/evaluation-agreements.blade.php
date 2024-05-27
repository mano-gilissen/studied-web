    <div class="agreements">

    <div class="title">{{ __('Nieuwe vakafspraken') }}</div>

    <div style="display: flex; align-items: center">

        <img class="button" id="button-previous" src="/images_app/back.svg"/>

        <div class="wrap">

            <div id="agreements">

                @php $agreements = $evaluation->getAgreements @endphp

                @if($agreements->count() > 0)

                    @foreach($agreements as $agreement)

                        <div class="agreement" id="{{ $agreement->id }}" data-subject="{{ $agreement->subject }}" onclick="window.location.href='{{ route('agreement.view', ['identifier' => $agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}]) }}'">

                            <div class="top">

                                <div class="title">{{ $agreement->identifier }}</div>

                            </div>

                            <div class="bottom">

                                @php $forHost = false @endphp

                                @if($forHost ? $agreement->getStudent->getPerson->avatar : $agreement->getEmployee->getPerson->avatar)

                                    <img src="{{ asset("storage/avatar/" . ($forHost ? $agreement->getStudent->getPerson->avatar : $agreement->getEmployee->getPerson->avatar)) }}"/>

                                @else

                                    <div>

                                        <div class="no-avatar">{{ \App\Http\Traits\PersonTrait::getInitials($forHost ? $agreement->getStudent->getPerson : $agreement->getEmployee->getPerson) }}</div>

                                    </div>

                                @endif

                                <div>{!! \App\Http\Traits\AgreementTrait::getDescription($agreement, $forHost) !!} @if(\App\Http\Traits\AgreementTrait::getStatus($agreement) == \App\Http\Traits\AgreementTrait::$STATUS_EXPIRED) <span class="expired"> (Verlopen)</span> @elseif($agreement->{\App\Http\Support\Model::$AGREEMENT_STATUS} == \App\Http\Traits\AgreementTrait::$STATUS_UNAPPROVED || $agreement->{\App\Http\Support\Model::$AGREEMENT_STATUS} == \App\Http\Traits\AgreementTrait::$STATUS_TRIAL) <span class="trial">{{ __(' (Proefles)') }}</span> @endif</div>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="block-note">{{ __('Er zijn na aanleiding van dit gesprek geen nieuwe vakafspraken aangemaakt.') }}</div>

                @endif

            </div>

        </div>

        <img class="button" id="button-next" src="/images_app/forward.svg"/>

    </div>

</div>
