@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :first_name', [
                    'first_name' => $customer->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
            </p><br>

            @if(\App\Http\Traits\EvaluationTrait::hasLink($evaluation))
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {!! __('De gegevens van uw :regarding met :employee zijn gewijzigd. Het gesprek is nu digitaal op :date om :time. Dit is de link naar het gesprek: :link', [
                        'regarding' => \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation),
                        'employee' => $evaluation->getEmployee->getPerson->first_name,
                        'date' => strtolower(\App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_SINGLE)),
                        'time' => \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$TIME_SINGLE),
                        'link' => '<a href="' . $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK} . '">' . $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK} . '</a>'
                    ]) !!}
                </p>
            @else
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {{ __('De gegevens van uw :regarding met :employee zijn gewijzigd. Het gesprek is nu op :date om :time en de locatie is: :location', [
                        'regarding' => \App\Http\Traits\EvaluationTrait::getRegardingText($evaluation),
                        'employee' => $evaluation->getEmployee->getPerson->first_name,
                        'date' => strtolower(\App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_SINGLE)),
                        'time' => \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$TIME_SINGLE),
                        'location' => $evaluation->{\App\Http\Support\Model::$EVALUATION_LOCATION_TEXT}
                    ]) }}
                </p>
            @endif
            <br>
            {{ __('U kunt de gegevens van het gesprek bekijken in onze webapp. Mocht u vragen hebben, aarzel dan niet contact op te nemen.') }}
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
