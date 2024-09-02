@php $display_block = false; @endphp

@foreach($question_numbers as $question_number)

    @if(strlen($answers[$question_number]) > 0)

        @php $display_block = true; @endphp

    @endif

@endforeach

@if($display_block)

    <div class="subtitle">{{ __($subtitle) }}</div>

    <div class="content-fold">

        @foreach ($question_numbers as $question_number)

            @include('block.evaluation-question', [
                'question' => $questions[$question_number],
                'answer' => $answers[$question_number]
            ])

        @endforeach

    </div>

@endif
