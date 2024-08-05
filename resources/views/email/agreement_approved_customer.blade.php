@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :prefix :middle_name :last_name', [
                    'prefix' => strlen($user->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX}) > 0 ? $user->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX} . ' ' : '',
                    'middle_name' => strlen($user->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME}) > 0 ? $user->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME} . ' ' : '',
                    'last_name' => $user->getPerson->{\App\Http\Support\Model::$PERSON_LAST_NAME}
                ]) }},
                <br>
                {{ __('De proefles van :student_first_name met :host_first_name was een succes! Dat betekent dat :student_first_name nu officieel begeleiding van :host_first_name krijgt.', [
                    'student_first_name' => $student->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME},
                    'host_first_name' => $study->getHost->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }}
                <br>
                {{ __('De vakafspraken zijn definitief. Dat betekent dat er elke maand lessen met :student_first_name worden ingepland conform deze afspraken. De vakafspraken gelden voor een bepaalde tijd. Bij het evaluatiegesprek wordt gekeken of deze moeten worden verlengd, gewijzigd of beëindigd. Zo sluit onze begeleiding nog beter aan op de behoefte van de scholier.', [
                    'student_first_name' => $student->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }}
                <br>
                {{ __('U kunt de begeleiding volgen in onze webapp. Mocht u vragen hebben, aarzel dan niet contact op te nemen.') }}
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
