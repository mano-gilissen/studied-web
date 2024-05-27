<div class="block-attributes">

    <div class="title">{{ __('Gegevens') }}</div>

    <div class="list-attributes">

        <div class="attribute">

            <div class="name">{{ __('Vak') }}</div>

            <div class="value">{{ $study->{\App\Http\Support\Model::$STUDY_SUBJECT_TEXT} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Dienst') }}</div>

            <div class="value">{{ $study->getService->{\App\Http\Support\Model::$SERVICE_NAME} }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Datum') }}</div>

            <div class="value">{{ \App\Http\Support\Format::datetime($study->start, \App\Http\Support\Format::$DATETIME_SINGLE) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Tijdstip') }}</div>

            <div class="value">{{ \App\Http\Traits\StudyTrait::getTimeText($study) }}</div>

        </div>

        <div class="attribute">

            <div class="name">{{ __('Status') }}</div>

            <div class="value">

                <div class="tag" style="background: {{\App\Http\Traits\StudyTrait::getStatusColor(\App\Http\Traits\StudyTrait::getStatus($study))}};color: {{\App\Http\Traits\StudyTrait::getStatusTextColor($study)}}">{{ \App\Http\Traits\StudyTrait::getStatusText(\App\Http\Traits\StudyTrait::getStatus($study)) }}</div>

            </div>

        </div>

    </div>

</div>
