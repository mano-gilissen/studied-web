@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :full_name', [
                    'full_name' => (strlen($user->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX}) > 0 ? $user->getPerson->{\App\Http\Support\Model::$PERSON_PREFIX} . ' ' : '') . (strlen($user->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME}) > 0 ? $user->getPerson->{\App\Http\Support\Model::$PERSON_MIDDLE_NAME} . ' ' : '') . $user->getPerson->{\App\Http\Support\Model::$PERSON_LAST_NAME}
                ]) }},
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Bij Studied werken we met onze eigen webapp. Hiermee krijgt u toegang tot de lessen, lesrapporten en overige gegevens met betrekking tot de begeleiding. U wordt hierover op de hoogte gehouden middels automatisch gegenereerde e-mails. Zo wordt onze begeleiding nog sneller, transparanter en afgemeten op de behoefte van de scholier.') }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Klik op de onderstaande button om uw account te activeren. Mocht u vragen hebben, aarzel dan niet contact op te nemen.') }}
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ route('user.activate', [$user->{\App\Http\Support\Model::$USER_ACTIVATE_SECRET}]) }}" style="color: white; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Account activeren') }}
            </a>
        </td>
    </tr>

@endsection
