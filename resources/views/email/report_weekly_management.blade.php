@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            {{ __('Hi team,') }},
            <br><br>
            {{ __('Dit is de wekelijkse controle email voor de Studied backoffice van ') . date('d-m-Y', strtotime('-7 days')) . ' tot ' . date('d-m-Y') . ' (weeknummer ' . date('W') . ').' }},
            <br><br><br>
            <div style="font-weight: bold">{{ __('Achterstand gemaakte uren') }}</div>
            {{ __('Onderstaande lijst betreft alle leerlingen met een achterstand van gemaakte uren ten opzichte van de lopende vakafspraken. Dit wordt berekend op basis van hoe lang de vakafspraak nog duurt en hoeveel uren er in totaal gemaakt moeten worden. Een achterstand betekent dat het totaal aantal uren op dit tempo niet gehaald gaat worden.') }}
            <br><br>
            @foreach($list_deficit as $deficit)

                {{ ' - ' . $deficit[0] . ': ' . $deficit[1] . ' uren' }}
                <br>

            @endforeach
            <br><br><br>
            <div style="font-weight: bold">{{ __('Achterstand gerapporteerde lessen') }}</div>
            {{ __('Onderstaande lijst betreft alle medewerkers met een achterstand in het afronden van lessen. Deze lessen zijn afgelopen maar zijn nog niet gerapporteerd, verzuimd of geannuleerd.') }}
            <br><br>
            @foreach($list_unreported as $unreported)

                {{ ' - ' . $unreported[0] . ': ' . $unreported[1] . ' lessen' }}
                <br>

            @endforeach
            <br><br><br>
            <div style="font-weight: bold">{{ __('Controle rapport teksten') }}</div>
            {{ __('Klik onderstaand om een CSV van alle rapportages te downloaden van afgelopen week. Het is de bedoeling dat alle rapport teksten gecontroleerd worden op lege velden, niet-inhoudelijke input en copy-pasten. Dit is namelijk niet de bedoeling.') }}
            <br><br>
            <a href="{{ route('report.export', ['time' => time()]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Download CSV') }}
            </a>
        </td>
    </tr>

@endsection
