<div id="pva" class="block-attributes">

    @php $answers = json_decode($evaluation->{\App\Http\Support\Model::$EVALUATION_ANSWERS} ?? '{}', true); @endphp

    @switch($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING})

        @case(\App\Http\Traits\EvaluationTrait::$ID_INTAKE)

            <div class="title">{{ 'Plan van aanpak' }}</div>

            @include('section.evaluation-block', [
                'subtitle'                      => 'De doelstelling',
                'question_numbers'              => [0,1,2,3,4],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Stand van zaken',
                'question_numbers'              => [5,6,7,8,9,10,11],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'De mogelijkheden',
                'question_numbers'              => [12,13,14,15,16,17,18],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'De acties',
                'question_numbers'              => [19,20,21,22],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Afspraken',
                'question_numbers'              => [23,24,25,26,27,28,29,30,31,32],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_INTAKE
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Proefles',
                'question_numbers'              => [33,34,35],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Overig',
                'question_numbers'              => [36],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @break

        @case(\App\Http\Traits\EvaluationTrait::$ID_EVALUATION)
        @case(\App\Http\Traits\EvaluationTrait::$ID_YEAR_END)
        @case(\App\Http\Traits\EvaluationTrait::$ID_EXIT)

            <div class="title">{{ 'Plan van aanpak' }}</div>

            @include('section.evaluation-block', [
                'subtitle'                      => 'De doelstelling',
                'question_numbers'              => [0,1,2,3,4],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Stand van zaken',
                'question_numbers'              => [5,6,7,8,9,10,11],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'De mogelijkheden',
                'question_numbers'              => [12,13,14,15,16,17,18],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'De acties',
                'question_numbers'              => [19,20,21,22],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Afspraken',
                'question_numbers'              => [23,24,25,26,27,28,29,30,31,32],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Proefles',
                'question_numbers'              => [33,34,35],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Evaluatie',
                'question_numbers'              => [36,37,38,39,40,41,42,43,44,45],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @include('section.evaluation-block', [
                'subtitle'                      => 'Overig',
                'question_numbers'              => [46],
                'questions'                     => \App\Http\Traits\EvaluationTrait::$QUESTIONS_EVALUATION
            ])

            @break

    @endswitch

</div>
