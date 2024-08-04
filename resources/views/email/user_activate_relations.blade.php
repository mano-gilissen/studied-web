@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :relation_name', [
                    'relation_name' => $relation_name
                ]) }},
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __(':student_first_name heeft zich aangemeld voor onze begeleiding.', [
                    'student_first_name' => $student->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Bij Studied vinden we het contact met de mentor en docent van de scholier net zo belangrijk als het contact met de scholier zelf, zodoende kunnen wij iedere scholier naar behoefte ondersteunen. Neem gerust contact met ons op wanneer u (nieuwe) problematieken constateert of aan te raden oefenmateriaal heeft!') }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('We hopen u hiermee voldoende geïnformeerd te hebben. Mocht u vragen hebben, neem dan gerust contact met ons op!') }}
            </p>
        </td>
    </tr>

@endsection
