@extends('form.template')



@section('css-form')

    <style>

        #reason_cancel-field {

            display: {{ $study->{\App\Http\Support\Model::$STUDY_STATUS} == \App\Http\Traits\StudyTrait::$STATUS_CANCELLED ? 'flex' : 'none' }};

        }

        #explanation_cancel-field {

            display: {{ in_array($study->{\App\Http\Support\Model::$STUDY_STATUS}, [\App\Http\Traits\StudyTrait::$STATUS_ABSENT, \App\Http\Traits\StudyTrait::$STATUS_CANCELLED]) ? 'flex' : 'none' }};

        }

    </style>

@endsection



@section('scripts-form')

    <script>

        function study_cancel_reason() {

            $('#reason_cancel-field, #explanation_cancel-field').hide();

            if ($('#_status').val() === '5') {

                $('#reason_cancel-field, #explanation_cancel-field').css('display', 'flex');

            } else if ($('#_status').val() === '6') {

                $('#explanation_cancel-field').css('display', 'flex');

            }
        }

    </script>

@endsection



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('component.field-input', ['id' => 'date', 'type' => 'date', 'tag' => __('Datum'), 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($study->{\App\Http\Support\Model::$STUDY_START}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('component.field-select-time', ['set_start' => $study->start, 'set_end' => $study->end])

    @include('component.field-input', ['id' => 'location', 'tag' => __('Locatie'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een locatie'), 'required' => true, 'data' => true, 'show_all' => true, 'uses_id' => true, 'set_id' => ($current_location ?? false) ? $current_location : -1])

    @include('component.field-input', ['id' => 'link', 'tag' => __('Digitale les'), 'icon' => 'url.svg', 'placeholder' => __('Plak een URL'), 'value' => $study->{\App\Http\Support\Model::$STUDY_LINK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Gegevens') }}</div>

    @include('component.field-input', [

        'id' => 'status',
        'tag' => __('Status'),
        'icon' => 'dropdown.svg',
        'placeholder' => __('Kies een status'),

        'required' => true,
        'data' => true,
        'show_all' => true,
        'show_always' => true,
        'reject_other' => true,
        'uses_id' => true,

        'trigger' => 'study_cancel',
        'locked' => \App\Http\Traits\StudyTrait::isReported($study),
        'set_id' => $study->{\App\Http\Support\Model::$STUDY_STATUS}
    ])

    @include('component.field-input', ['id' => 'reason_cancel', 'tag' => __('Reden annuleren / verzuim'), 'icon' => 'dropdown.svg', 'placeholder' => __('Kies een reden'), 'data' => true, 'show_all' => true, 'show_always' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $study->{\App\Http\Support\Model::$STUDY_REASON_CANCEL}])

    @include('component.field-input', ['id' => 'explanation_cancel', 'tag' => __('Uitleg annuleren / verzuim'), 'value' => $study->{\App\Http\Support\Model::$STUDY_EXPLANATION_CANCEL}])

    @include('component.field-input', ['id' => 'remark', 'tag' => __('Opmerking'), 'value' => $study->{\App\Http\Support\Model::$STUDY_REMARK}])

    <div class="seperator"></div>



    @if(\App\Http\Traits\BaseTrait::hasManagementRights())

        <div class="title">{{ __('Acties') }}</div>

        <div class="field">

            <div class="name">{{ __('Verwijderen') }}</div>

            <div class="button red" style="margin-top: 4px;" onclick="navigate('{{ route('study.delete', [\App\Http\Support\Model::$BASE_KEY => $study->key]) }}')">

                <div class="text">{{ __('Les verwijderen') }}</div>

            </div>

        </div>

    @endif



    @include('component.field-hidden', ['id' => '_study', 'value' => $study->id])



@endsection
