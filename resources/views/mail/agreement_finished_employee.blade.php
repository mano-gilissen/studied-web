@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :first_name', [
                    'first_name' => $employee->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
                <br>
                {{ __('De vakafspraak met :student_first_name voor :subject_name is afgehandeld. Dat betekent dat je geen lessen meer kan inplannen met deze vakafspraak.', [
                    'student_first_name' => $student->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME},
                    'subject_name' => $agreement->getSubject->{\App\Http\Support\Model::$SUBJECT_NAME}
                ]) }}
                <br>
                {{ __('Je kunt je vakafspraken bekijken in onze webapp. Mocht je vragen hebben, aarzel dan niet contact op te nemen.') }}
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ route('agreement.view', [$agreement->{\App\Http\Support\Model::$AGREEMENT_IDENTIFIER}]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Vakafspraak bekijken') }}
            </a>
        </td>
    </tr>

@endsection
