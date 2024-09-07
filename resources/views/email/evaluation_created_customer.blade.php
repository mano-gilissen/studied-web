@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :full_name', [
                    'full_name' => (strlen($customer->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX}) > 0 ? $customer->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX} . ' ' : '') . (strlen($customer->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME}) > 0 ? $customer->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME} . ' ' : '') . $customer->getPerson->{\App\Http\Support\Model::$PERSON_LAST_NAME}
                ]) }},
            </p><br>

            @if(\App\Http\Traits\EvaluationTrait::hasLink($evaluation))
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {!! __('Er is een gesprek met u ingepland. Het gesprek is digitaal op :date om :time. Dit is de link naar het gesprek: :link', [
                        'date' => strtolower(\App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$DATETIME_SINGLE)),
                        'time' => \App\Http\Support\Format::datetime($evaluation->{\App\Http\Support\Model::$EVALUATION_DATETIME}, \App\Http\Support\Format::$TIME_SINGLE),
                        'link' => '<a href="' . $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK} . '">' . $evaluation->{\App\Http\Support\Model::$EVALUATION_LINK} . '</a>'
                    ]) !!}
                </p>
            @else
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {{ __('Er is een gesprek met u ingepland. Het gesprek is op :date om :time en de locatie is: :location', [
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
