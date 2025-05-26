@extends('template.form')



@section('scripts')

    <script src="{{ asset('js/form_210525.js') }}"></script>
    <script src="{{ asset('js/evaluation_210525.js') }}"></script>

@endsection



@section('css-form')

    <style>

        @media (max-width: 840px) {

            #form .field {
                display: block
            }

            #form .field .name {
                height: unset;
            }
        }

    </style>

@endsection



@section('fields')



    <div class="block-note">{{ __('Dit is het gesprek van') }}&nbsp;<span style="font-weight: 400">{{ \App\Http\Traits\PersonTrait::getFullName($evaluation->getStudent->getPerson) }}</span></div>

    <div class="seperator"></div>



    @if($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING} == \App\Http\Traits\EvaluationTrait::$ID_INTAKE)

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - De doelstelling',
            'question_numbers'                              => [0,1,2,3,4],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - Stand van zaken',
            'question_numbers'                              => [5,6,7,8,9,10,11],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - De mogelijkheden',
            'question_numbers'                              => [12,13,14,15,16,17,18],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - De acties',
            'question_numbers'                              => [19,20,21,22],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Afspraken',
            'question_numbers'                              => [23,24,25,26,27,28,29,30,31,32],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Proefles',
            'question_numbers'                              => [33,34,35],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Overig',
            'question_numbers'                              => [36],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
        ])

    @endif



    @if(in_array($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING}, array(
            \App\Http\Traits\EvaluationTrait::$ID_EVALUATION,
            \App\Http\Traits\EvaluationTrait::$ID_YEAR_END,
            \App\Http\Traits\EvaluationTrait::$ID_EXIT)))

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - De doelstelling',
            'question_numbers'                              => [0,1,2,3,4],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - Stand van zaken',
            'question_numbers'                              => [5,6,7,8,9,10,11],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - De mogelijkheden',
            'question_numbers'                              => [12,13,14,15,16,17,18],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'PVA - De acties',
            'question_numbers'                              => [19,20,21,22],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Afspraken',
            'question_numbers'                              => [23,24,25,26,27,28,29,30,31,32],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Proefles',
            'question_numbers'                              => [33,34,35],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Evaluatie',
            'question_numbers'                              => [36,37,38,39,40,41,42,43,44,45],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

        @include('form-evaluation-questions', [
            'title'                                         => 'Overig',
            'question_numbers'                              => [46],
            'questions'                                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
        ])

    @endif



    <div class="seperator large"></div>



    <div id="agreements-wrap"></div>

    <div id="button-add-agreement" class="button grey" onclick="evaluation_agreement_load('{{ $evaluation->id }}');">{{ __('Vakafspraak toevoegen') }}</div>



    @include('form.field-hidden', ['id' => '_evaluation', 'value' => $evaluation->id])



@endsection
