@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Hallo :first_name', [
                    'first_name' => $user->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
                <br><br>
                {!! __('Er staat een nieuwe aankondiging voor je klaar in het dashboard. Bekijk deze eenvoudig in de app via de onderstaande knop.') !!}
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ route('dashboard.view') }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Bericht bekijken') }}
            </a>
        </td>
    </tr>
    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                <br><br><br>
                {{ __('Groeten,') }}
                <br><br>
                {{ __('Studied Webapp') }}
            </p>
        </td>
    </tr>

@endsection
