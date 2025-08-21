<div class="block-attributes" id="block-agreement-details-1">

    <div class="title">Gegevens</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ __('Vak en niveau') }}</div>

            <div class="value">{{ \App\Http\Traits\AgreementTrait::getVakcode($agreement) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Geldig vanaf') }}</div>

            <div class="value">{{ \App\Http\Support\Format::datetime($agreement->start, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Geldig tot') }}</div>

            <div class="value">{{ \App\Http\Support\Format::datetime($agreement->end, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Status') }}</div>

            <div class="value">

                <div class="tag" style="background: {{\App\Http\Traits\AgreementTrait::getStatusColor(\App\Http\Traits\AgreementTrait::getStatus($agreement))}};color: {{\App\Http\Traits\AgreementTrait::getStatusTextColor(\App\Http\Traits\AgreementTrait::getStatus($agreement))}}">{{ \App\Http\Traits\AgreementTrait::getStatusText(\App\Http\Traits\AgreementTrait::getStatus($agreement)) }}</div>

            </div>

        </div>

    </div>

</div>
