@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            {{ __('Hi team,') }}
            <br><br>
            {{ __('Dit is de wekelijkse controle email voor de lesadminisratie van ') . date('d-m-Y', strtotime('-7 days')) . ' tot ' . date('d-m-Y') . ' (week ' . date('W', strtotime('-7 days')) . ').' }}
            <br><br><br>
            <div style="font-weight: bold">{{ __('Overzicht leerlingen met urenachterstand') }}</div>
            {{ __('De onderstaande lijst bevat alle leerlingen die een achterstand hebben in het aantal gemaakte uren ten opzichte van de lopende vakafspraken. Deze achterstand wordt berekend op basis van de resterende duur van de vakafspraak en het totaal aantal te maken uren. Een achterstand betekent dat, bij het huidige tempo, het vereiste aantal uren niet behaald zal worden.') }}
            <br><br>
            @foreach($list_deficit as $deficit)

                {{ ' - ' . $deficit[0] . ': ' . $deficit[1] . ' uren' }}
                <br>

            @endforeach
            <br><br><br>
            <div style="font-weight: bold">{{ __('Overzicht achterstand gerapporteerde lessen') }}</div>
            {{ __('De onderstaande lijst bevat alle medewerkers met een achterstand in het afronden van lessen. Deze lessen zijn inmiddels afgelopen, maar staan nog niet op gerapporteerd, verzuimd of geannuleerd.') }}
            <br><br>
            @foreach($list_unreported as $unreported)

                {{ ' - ' . $unreported[0] . ': ' . $unreported[1] . ($unreported[1] > 1 ? ' lessen' : ' les') }}
                <br>

            @endforeach
            <br><br><br>
            <div style="font-weight: bold">{{ __('Controle rapportteksten') }}</div>
            {{ __('Klik hieronder om een CSV-bestand met alle lesrapporten van de afgelopen week te downloaden. Alle rapportteksten dienen gecontroleerd te worden op lege velden, niet-inhoudelijke input en gekopieerde tekst, aangezien dit niet is toegestaan.') }}
            <br><br>
            <a href="{{ route('report.export', ['time' => time()]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Download CSV') }}
            </a>
            <br><br>
            {{ __('Dank voor de inzet bij de controle! Mocht je vragen hebben of iets niet duidelijk zijn, laat het dan even weten aan Bas.') }}
            <br><br><br>
            {{ __('Groeten,') }}
            <br><br>
            {{ __('Studied Webapp') }}
        </td>
    </tr>

@endsection
