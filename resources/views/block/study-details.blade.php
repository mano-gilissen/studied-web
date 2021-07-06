<div class="block-attributes">

    <div class="title">Gegevens</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">Vak</div>

            <div class="value">{{ $study->getSubject_Defined ? $study->getSubject_Defined->code : $study->subject_text }}</div>

        </div>

        <div class="attribute">

            <div class="name">Datum</div>

            {{ \App\Http\Support\Format::datetime($study->created_at) }}

        </div>

        <div class="attribute">

            <div class="name">Tijdstip</div>

            <div class="value">{{ $study->start . ' - ' . $study->end  }}</div>

        </div>

        <div class="attribute">

            <div class="name">Status</div>

            <div class="value">

                <div class="tag" style="background: {{\App\Http\Traits\StudyTrait::getStatusColor($study)}};color: {{\App\Http\Traits\StudyTrait::getStatusTextColor($study)}}">{{ \App\Http\Traits\StudyTrait::getStatus($study) }}</div>

            </div>

        </div>

    </div>

</div>
