<div class="block-attributes">

    <div class="no-title"></div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ __('Dienst') }}</div>

            <div class="value">{{ $agreement->getService->{\App\Http\Support\Model::$SERVICE_NAME} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_EXTENSION} ? __('Verlenging van') : __('Verlenging') }}</div>

            <div class="value">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_EXTENSION} ?? __('Nee') }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Begeleiding') }}</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getPlanText($agreement->{\App\Http\Support\Model::$AGREEMENT_PLAN}) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Voorkeur individueel of groepsles') }}</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getPreferenceGroupData()[$agreement->{\App\Http\Support\Model::$AGREEMENT_PREFERENCE_GROUP}] }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Voorkeur locatie fysiek of digitaal') }}</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getPreferenceLocationData()[$agreement->{\App\Http\Support\Model::$AGREEMENT_PREFERENCE_LOCATION}] }}</div>

        </div>

        @if(\App\Http\Traits\AgreementTrait::getTrial($agreement))

            <div class="attribute">

                <div class="name">{{ 'Proefles' }}</div>

                <div class="value"><div class="button" onclick="navigate('{{ route('study.view', ['key' => \App\Http\Traits\AgreementTrait::getTrial($agreement)->{\App\Http\Support\Model::$BASE_KEY}]) }}')">{{ __('Bekijken') }}</div></div>

            </div>

        @endif

    </div>

    <div class="list-attributes" style="margin-top: 24px;">

        <div class="attribute">

            <div class="name">{{ __('Uren afspraak') }}</div>

            <div class="value">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_HOURS} . __(' per week, ') . \App\Http\Traits\AgreementTrait::getHoursTotal($agreement) . __(' in totaal')}}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Uren gemaakt') }}</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getHoursMade($agreement) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Uren achterstand') }}</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::calculateDeficit($agreement) }}</div>

        </div>

    </div>

    <div class="content-fold">

        <div class="item">

            <div class="item-title">

                <div>{{ __('Opmerking') }}</div>

                <img src="/images_app/chevron-down.svg">

            </div>

            <p>{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_REMARK} }}</p>

        </div>

    </div>

</div>
