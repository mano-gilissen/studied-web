<div class="block-attributes">

    <div class="no-title"></div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Dienst</div>

            <div class="value">{{ $agreement->getService->{\App\Http\Support\Model::$SERVICE_NAME} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_EXTENSION} ? 'Verlenging van' : 'Verlenging' }}</div>

            <div class="value">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_EXTENSION} ?? 'Nee' }}</div>

        </div>

        <div class="attribute">

            <div class="name">Begeleiding</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getPlanText($agreement->{\App\Http\Support\Model::$AGREEMENT_PLAN}) }}</div>

        </div>

        @if(\App\Http\Traits\AgreementTrait::getTrial($agreement))

            <div class="attribute">

                <div class="name">{{ 'Proefles' }}</div>

                <div class="value"><div class="button" onclick="window.location.href='{{ route('study.view', ['key' => \App\Http\Traits\AgreementTrait::getTrial($agreement)->{\App\Http\Support\Model::$BASE_KEY}]) }}'">Bekijken</div></div>

            </div>

        @endif

    </div>

    <div class="list-attributes" style="margin-top: 24px;">

        <div class="attribute">

            <div class="name">Uren afspraak</div>

            <div class="value">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_HOURS} . ' per week, ' . \App\Http\Traits\AgreementTrait::getHoursTotal($agreement) . ' in totaal'}}</div>

        </div>

        <div class="attribute">

            <div class="name">Uren gemaakt</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getHoursMade($agreement) }}</div>

        </div>

    </div>

    <div class="content-fold">

        <div class="item">

            <div class="item-title">

                <div>Opmerking</div>

                <img src="/images_app/chevron-down.svg">

            </div>

            <p>{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_REMARK} }}</p>

        </div>

    </div>

</div>
