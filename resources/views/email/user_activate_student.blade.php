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
                {{ __('De proefles met :host_first_name was een succes! Dat betekent dat je officieel begeleiding bij ons volgt.', [
                    'host_first_name' => $study->getHost->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('We werken met onze eigen webapp. Hiermee krijgt je toegang tot de lessen, lesrapporten en overige gegevens met betrekking tot je begeleiding. Je wordt hierover op de hoogte gehouden middels automatisch gegenereerde e-mails. Zo wordt onze begeleiding nóg sneller, meer transparant en meer afgemeten op jou behoeftes.') }}
            </p>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Klik op de onderstaande knop om je account te activeren. Mocht je vragen hebben, aarzel dan niet contact op te nemen.') }}
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
