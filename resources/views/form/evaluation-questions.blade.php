<div class="title">{{ __($title) }}</div>

@foreach($question_numbers as $question_number)

    @include('component.field-textarea', ['id' => 'answers_' . $question_number, 'tag' => __($questions[$question_number]), 'value' => old('answers_' . $question_number)])

@endforeach

<div class="seperator"></div>
