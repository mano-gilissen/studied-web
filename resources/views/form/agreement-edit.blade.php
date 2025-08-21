@extends('form.template')



@section('css-form')

    <!-- Align subject and level fields vertically on mobile -->

    <style>

        @media (max-width: 840px) {

            #form .block-form #field-subject-level  {
                display: grid;
                grid-template-columns: 1fr 2fr;
                grid-template-rows: auto auto;
                grid-row-gap: 32px;
            }

            #form .block-form #field-subject-level .width-third {
                width: 100%;
            }

            #form .block-form #field-subject-level .width-third.note {
                justify-content: start;
            }
        }

    </style>

@endsection



@section('fields')

    <div class="title">{{ __('Vakafspraak') }}</div>

    @include('component.field-input', ['id' => 'student', 'tag' => __('Leerling'), 'icon' => 'lock.svg','locked' => true, 'value' => \App\Http\Traits\PersonTrait::getFullName(($agreement->getStudent->getPerson))])

    @include('component.field-input', ['id' => 'employee', 'tag' => __('Student-docent'), 'icon' => 'lock.svg', 'locked' => true, 'value' => \App\Http\Traits\PersonTrait::getFullName(($agreement->getEmployee->getPerson))])

    @include('component.field-input', ['id' => 'service', 'tag' => __('Dienst'), 'icon' => 'lock.svg', 'locked' => true, 'value' => $agreement->getService->{\App\Http\Support\Model::$SERVICE_NAME}])

    @include('component.field-input', ['id' => 'plan', 'tag' => __('Begeleidingsvorm'), 'icon' => 'lock.svg', 'locked' => true, 'value' => \App\Http\Traits\AgreementTrait::getPlanText($agreement->{\App\Http\Support\Model::$AGREEMENT_PLAN})])

    <div class="field" id="field-subject-level">

        <div class="name">{{ __('Vak') }}</div>

        @include('component.box-input', ['id' => 'subject', 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'subject', 'uses_id' => true, 'size' => 'width-third', 'set_id' => $agreement->{\App\Http\Support\Model::$SUBJECT}])

        <div class="name width-third">{{ __('Niveau') }}</div>

        @include('component.box-input', ['id' => 'level', 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'level', 'uses_id' => true, 'size' => 'width-third', 'set_id' => $agreement->{\App\Http\Support\Model::$LEVEL}])

    </div>

    @include('component.field-input', ['id' => 'hours', 'type' => 'number', 'tag' => __('Uren per week'), 'required' => true, 'value' => $agreement->{\App\Http\Support\Model::$AGREEMENT_HOURS}])

    @include('component.field-input', ['id' => 'start', 'type' => 'date', 'tag' => __('Geldig vanaf'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($agreement->{\App\Http\Support\Model::$AGREEMENT_START}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('component.field-input', ['id' => 'end', 'type' => 'date', 'tag' => __('Geldig tot'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($agreement->{\App\Http\Support\Model::$AGREEMENT_END}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('component.field-input', ['id' => 'preference_group', 'tag' => __('Voorkeur groepsles of individueel'), 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'show_always' => true, 'ac_data' => 'preference_group', 'uses_id' => true, 'set_id' => $agreement->{\App\Http\Support\Model::$AGREEMENT_PREFERENCE_GROUP}])

    @include('component.field-input', ['id' => 'preference_location', 'tag' => __('Voorkeur locatie fysiek of digitaal'), 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'show_always' => true, 'ac_data' => 'preference_location', 'uses_id' => true, 'set_id' => $agreement->{\App\Http\Support\Model::$AGREEMENT_PREFERENCE_LOCATION}])

    @include('component.field-textarea', ['id' => 'remark', 'tag' => __('Opmerkingen'), 'value' => $agreement->{\App\Http\Support\Model::$AGREEMENT_REMARK}])

    <div class="seperator large"></div>



    @include('component.field-hidden', ['id' => 'agreement', 'value' => $agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}])




@endsection
