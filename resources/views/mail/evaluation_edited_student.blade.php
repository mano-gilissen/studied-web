@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :first_name', [
                    'first_name' => $student->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
            </p><br>

            @if(\App\Http\Traits\EvaluationTrait::hasLink($evaluation))
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {!! __('De gegevens van je :regarding zijn gewijzigd. Het gesprek is nu digitaal op :date om :time. Dit is de link naar het gesprek: :link', [
                        'regarding' => strtolower(\App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING})),
                        'date' => strtolower(\App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_SINGLE, $student->{\App\Http\Support\Model::$USER_LANGUAGE})),
                        'time' => \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$TIME_SINGLE, $student->{\App\Http\Support\Model::$USER_LANGUAGE}),
                        'link' => '<a href="' . $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK} . '">' . $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK} . '</a>'
                    ]) !!}
                </p>
            @else
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {{ __('De gegevens van je :regarding zijn gewijzigd. Het gesprek is nu op :date om :time en de locatie is: :location', [
                        'regarding' => strtolower(\App\Http\Traits\EvaluationTrait::getRegardingText($evaluation->{\App\Http\Support\Model::$EVALUATION_REGARDING})),
                        'date' => strtolower(\App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_SINGLE, $student->{\App\Http\Support\Model::$USER_LANGUAGE})),
                        'time' => \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$TIME_SINGLE, $student->{\App\Http\Support\Model::$USER_LANGUAGE}),
                        'location' => $evaluation->{\App\Http\Support\Model::$EVALUATION_LOCATION_TEXT}
                    ]) }}
                </p>
            @endif
            <br>
            {{ __('Je kunt de gegevens van het gesprek bekijken in onze webapp. Mocht je vragen hebben, aarzel dan niet contact op te nemen!') }}
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ route('evaluation.view', [$evaluation->{\App\Http\Support\Model::$BASE_KEY}]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Gesprek bekijken') }}
            </a>
        </td>
    </tr>

@endsection
