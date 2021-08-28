<div class="block-attributes">

    <div class="title">Gegevens</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Datum</div>

            <div class="value">{{ \App\Http\Support\Format::datetime($evaluation->datetime, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

        </div>

        <div class="attribute">

            <div class="name">Tijdstip</div>

            <div class="value">{{ \App\Http\Support\Format::datetime($evaluation->datetime, \App\Http\Support\Format::$TIME_SINGLE) }}</div>

        </div>

        <div class="attribute">

            <div class="name">Status</div>

            <div class="value">

                <div class="tag" style="background: {{\App\Http\Traits\EvaluationTrait::getStatusColor(\App\Http\Traits\EvaluationTrait::getStatus($evaluation))}};color: {{\App\Http\Traits\EvaluationTrait::getStatusTextColor(\App\Http\Traits\EvaluationTrait::getStatus($evaluation))}}">{{ \App\Http\Traits\EvaluationTrait::getStatusText(\App\Http\Traits\EvaluationTrait::getStatus($evaluation)) }}</div>

            </div>

        </div>

    </div>

</div>
