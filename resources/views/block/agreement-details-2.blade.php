<div class="block-attributes">

    <div class="no-title"></div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Uren per week</div>

            <div class="value">{{ $agreement->min . ' tot ' . $agreement->max }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_EXTENSION} ? 'Verlenging van' : 'Verlenging' }}</div>

            <div class="value">{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_EXTENSION} ?? 'Nee' }}</div>

        </div>

        <div class="content-fold">

            <div class="item">

                <div class="item-title">

                    <div>Opmerking</div>

                    <img src="/images/chevron-down.svg">

                </div>

                <p>{{ $agreement->{\App\Http\Support\Model::$AGREEMENT_REMARK} }}</p>

            </div>

        </div>

    </div>

</div>
