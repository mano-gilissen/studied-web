@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            {{ __('Beste Bas en management,') }},
            <br><br>
            {{ __('Dit is de wekelijkse controle email voor de Studied backoffice.') }},
            <br><br><br>
            <div style="font-weight: bold">{{ __('Achterstand gemaakte uren') }}</div>
            {{ __('Onderstaande lijst betreft alle leerlingen met een achterstand van gemaakte uren ten opzichte van de lopende vakafspraken:') }}
            <br><br>
            @foreach($list_deficit as $deficit)

                {{ ' - ' . $deficit[0] . ': ' . $deficit[1] . ' uren' }}
                <br>

            @endforeach
            <br><br><br>
            <div style="font-weight: bold">{{ __('Achterstand gerapporteerde lessen') }}</div>
            {{ __('Onderstaande lijst betreft alle medewerkers met een achterstand van gerapporteerde afgelopen lessen:') }}
            <br><br>
            @foreach($list_unreported as $unreported)

                {{ ' - ' . $unreported[0] . ': ' . $unreported[1] . ' lessen' }}
                <br>

            @endforeach
            <br><br><br>
            <div style="font-weight: bold">{{ __('Controle rapport teksten') }}</div>
            {{ __('Klik hier om een CSV van alle rapportages te downloaden van afgelopen week:') }}
            <br><br>
            <a href="{{ route('report.export', ['time' => time()]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Download CSV') }}
            </a>
        </td>
    </tr>

@endsection
