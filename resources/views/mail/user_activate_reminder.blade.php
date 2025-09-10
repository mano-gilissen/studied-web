@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :first_name', [
                    'first_name' => $user->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
            </p><br>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Bij deze een herinnering om je account te activeren in onze webapp.') }}
            </p><br>
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Klik op de onderstaande button om je account te activeren. Mocht je vragen hebben, aarzel dan niet contact op te nemen.') }}
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <a href="https://studied.app/activeren/{{ $user->{\App\Http\Support\Model::$USER_ACTIVATE_SECRET} }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;"><a href="{{ route('user.activate', [$user->{\App\Http\Support\Model::$USER_ACTIVATE_SECRET}]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Account activeren') }}
            </a>
        </td>
    </tr>

@endsection
