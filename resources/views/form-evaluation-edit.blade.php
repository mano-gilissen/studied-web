@extends('template.form')



@section('fields')



    <div class="title">{{ __('Tijd en locatie') }}</div>

    @include('form.field-input', ['id' => 'date', 'type' => 'date', 'tag' => __('Datum'), 'placeholder' => __('Kies een datum'), 'required' => true, 'value' => \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_FORM)])

    @include('form.field-select-time', ['end' => false, 'set_start' => $evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}])

    @include('form.field-input', ['id' => 'location', 'tag' => __('Locatie'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een locatie'), 'required' => true, 'data' => true, 'show_all' => true, 'uses_id' => true, 'value' => $evaluation->{\App\Http\Support\Model::$EVALUATION_LOCATION_TEXT}])

    @include('form.field-input', ['id' => 'link', 'tag' => __('Digitale meeting'), 'icon' => 'url.svg', 'placeholder' => __('Plak een URL'), 'value' => $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK}])

    <div class="seperator"></div>



    <div class="title">{{ __('Aanwezigen') }}</div>

    @include('form.field-input', ['id' => 'host', 'tag' => __('Host'), 'icon' => 'search.svg', 'placeholder' => __('Zoek een medewerker'), 'required' => true, 'data' => true, 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $evaluation->{\App\Http\Support\Model::$EVALUATION_HOST}])

    @foreach($evaluation->getEmployees as $employee)

        @include('form.field-input', ['id' => 'employee_' . $loop->iteration, 'tag' => __('Student-docent #' . $loop->iteration), 'icon' => 'search.svg', 'placeholder' => __('Zoek een student-docent'), 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true, 'set_id' => $employee->{\App\Http\Support\Model::$BASE_ID}])

    @endforeach

    @if(count($evaluation->getEmployees) < 3)

        @for($i = count($evaluation->getEmployees) + 1; $i <= 3; $i++)

            @include('form.field-input', ['id' => 'employee_' . $i, 'tag' => __('Student-docent #' . $i), 'icon' => 'search.svg', 'placeholder' => __('Zoek een student-docent'), 'required' => true, 'data' => true, 'ac_data' => 'employee', 'additional' => true, 'show_all' => true, 'reject_other' => true, 'uses_id' => true])

        @endfor

    @endif

    @include('form.field-input', ['id' => 'student', 'tag' => __('Leerling'), 'icon' => 'fix.svg', 'locked' => true, 'value' => \App\Http\Traits\PersonTrait::getFullName($evaluation->getStudent->getPerson)])

    <div class="seperator"></div>



    <div class="title">{{ __('Details') }}</div>

    @include('form.field-input', ['id' => 'regarding', 'tag' => __('Onderwerp'), 'required' => true, 'data' => true, 'uses_id' => true, 'show_all' => true, 'reject_other' => true, 'value' => \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING})])

    @include('form.field-textarea', ['id' => 'remark', 'tag' => __('Opmerking'), 'value' => $evaluation->{\App\Http\Support\Model::$EVALUATION_REMARKS}])



    @include('form.field-hidden', ['id' => 'evaluation', 'value' => $evaluation->{\App\Http\Support\Model::$BASE_KEY}])



@endsection
