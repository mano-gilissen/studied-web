@extends('template.form')



@section('fields')

    <div class="title">{{ __('Vakafspraak') }}</div>

    @include('form.field-input', ['id' => 'student', 'tag' => __('Leerling'), 'icon' => 'lock.svg','locked' => true, 'value' => \App\Http\Traits\PersonTrait::getFullName(($agreement->getStudent->getPerson))])

    @include('form.field-input', ['id' => 'employee', 'tag' => __('Student-docent'), 'icon' => 'lock.svg', 'locked' => true, 'value' => \App\Http\Traits\PersonTrait::getFullName(($agreement->getEmployee->getPerson))])

    @include('form.field-input', ['id' => 'service', 'tag' => __('Dienst'), 'icon' => 'lock.svg', 'locked' => true, 'value' => $agreement->getService->{\App\Http\Support\Model::$SERVICE_NAME}])

    @include('form.field-input', ['id' => 'plan', 'tag' => __('Begeleidingsvorm'), 'icon' => 'lock.svg', 'locked' => true, 'value' => \App\Http\Traits\AgreementTrait::getPlanText($agreement->{\App\Http\Support\Model::$AGREEMENT_PLAN})])

    <div class="field">

        <div class="name">{{ __('Vak') }}</div>

        @include('form.box-input', ['id' => 'subject', 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'subject', 'uses_id' => true, 'size' => 'width-third', 'set_id' => $agreement->{\App\Http\Support\Model::$SUBJECT}])

        <div class="note width-third">{{ __('Niveau') }}</div>

        @include('form.box-input', ['id' => 'level', 'required' => true, 'data' => true, 'reject_other' => true, 'show_all' => true, 'ac_data' => 'level', 'uses_id' => true, 'size' => 'width-third', 'set_id' => $agreement->{\App\Http\Support\Model::$LEVEL}])

    </div>

    @include('form.field-input', ['id' => 'hours', 'type' => 'number', 'tag' => __('Uren per week'), 'required' => true, 'value' => $agreement->{\App\Http\Support\Model::$AGREEMENT_HOURS}])

    @include('form.field-input', ['id' => 'start', 'type' => 'date', 'tag' => __('Geldig vanaf'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($agreement->{\App\Http\Support\Model::$AGREEMENT_START}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('form.field-input', ['id' => 'end', 'type' => 'date', 'tag' => __('Geldig tot'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($agreement->{\App\Http\Support\Model::$AGREEMENT_END}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('form.field-textarea', ['id' => 'remark', 'tag' => __('Opmerkingen'), 'value' => $agreement->{\App\Http\Support\Model::$AGREEMENT_REMARK}])

    <div class="seperator large"></div>



    @include('form.field-hidden', ['id' => 'agreement', 'value' => $agreement->{\App\Http\Support\Model::$BASE_KEY}])




@endsection
