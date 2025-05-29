@extends('template.form')



@section('css-form')

    <style>

        #reason_cancel,
        #explanation_cancel {

            display: {{ $study->{\App\Http\Support\Model::$STUDY_STATUS} == 5 ? 'block' : 'none' }};

        }

    </style>

@endsection



@section('scripts-form')

    <script>

        $('#_status').on('change', function () {

            if ($(this).val() === 5) {

                $('#reason_cancel, #explanation_cancel').show();

            } else {

                $('#reason_cancel, #explanation_cancel').hide();

            }
        });

    </script>

@endsection



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => __('Datum'), 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($study->{\App\Http\Support\Model::$STUDY_START}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('form.field-select-time', ['set_start' => $study->start, 'set_end' => $study->end])

    @include('form.field-input', ['id' => 'location', 'tag' => __('Locatie'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een locatie'), 'required' => true, 'data' => true, 'show_all' => true, 'uses_id' => true, 'set_id' => ($current_location ?? false) ? $current_location : -1])

    @include('form.field-input', ['id' => 'link', 'tag' => __('Digitale les'), 'icon' => 'url.svg', 'placeholder' => __('Plak een URL'), 'value' => $study->{\App\Http\Support\Model::$STUDY_LINK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Gegevens') }}</div>

    @include('form.field-input', ['id' => 'status', 'tag' => __('Status'), 'icon' => 'dropdown.svg', 'placeholder' => __('Kies een status'), 'required' => true, 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'locked' => \App\Http\Traits\StudyTrait::isReported($study), 'set_id' => $study->{\App\Http\Support\Model::$STUDY_STATUS}])

    @include('form.field-input', ['id' => 'reason_cancel', 'tag' => __('Reden annuleren/verzuim'), 'icon' => 'dropdown.svg', 'placeholder' => __('Kies een reden'), 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $study->{\App\Http\Support\Model::$STUDY_REASON_CANCEL}])

    @include('form.field-input', ['id' => 'explanation_cancel', 'tag' => __('Uitleg annuleren/verzuim'), 'value' => $study->{\App\Http\Support\Model::$STUDY_EXPLANATION_CANCEL}])

    @include('form.field-input', ['id' => 'remark', 'tag' => __('Opmerking'), 'value' => $study->{\App\Http\Support\Model::$STUDY_REMARK}])

    <div class="seperator"></div>



    @if(\App\Http\Traits\BaseTrait::hasManagementRights())

        <div class="title">{{ __('Acties') }}</div>

        <div class="field">

            <div class="name">{{ __('Verwijderen') }}</div>

            <div class="button red" style="margin-top: 4px;" onclick="window.location.href='{{ route('study.delete', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}'">

                <div class="text">{{ __('Les verwijderen') }}</div>

            </div>

        </div>

    @endif



    @include('form.field-hidden', ['id' => '_study', 'value' => $study->id])



@endsection
