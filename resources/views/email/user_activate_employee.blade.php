@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :first_name', [
                    'first_name' => $user->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('De documenten voor je indiensttreding zijn verwerkt. Dat betekent dat je officieel bij ons team hoort.') }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Activeer je account in onze webapp. Hiermee krijg je toegang tot de gegevens met betrekking tot je dienstbetrekking. Je wordt hierover op de hoogte gehouden middels automatisch gegenereerde e-mails.') }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Klik op de onderstaande button om je account te activeren. Mocht je vragen hebben, aarzel dan niet contact op te nemen.') }}
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
