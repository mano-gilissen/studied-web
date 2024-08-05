@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :full_name', [
                    'full_name' => (strlen($customer->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX}) > 0 ? $customer->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX} . ' ' : '') . (strlen($customer->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME}) > 0 ? $customer->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME} . ' ' : '') . $customer->getPerson->{\App\Http\Support\Model::$PERSON_LAST_NAME}
                ]) }},
            </p><br>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __(':student_name is als leerling toegevoegd aan uw account. Dat betekent dat u toegang heeft tot de lessen, lesrapporten en overige gegevens van zijn/haar begeleiding.', [
                    'student_name' => \App\Http\Traits\PersonTrait::getFullName($student->getPerson)
                ]) }}
            </p><br>
            {{ __('U kunt alle gegevens bekijken in onze webapp. Mocht u vragen hebben, aarzel dan niet contact op te nemen.') }}
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ route('person.view', [$student->getPerson->{\App\Http\Support\Model::$PERSON_SLUG}]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Leerling bekijken') }}
            </a>
        </td>
    </tr>

@endsection
