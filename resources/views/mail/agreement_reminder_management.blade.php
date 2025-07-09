@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            {{ __('Hi team,') }}
            <br><br>
            {!!
                __('Vakafspraak :agreement (losse lessen) van :employee heeft na 7 dagen nog geen lessen ingepland. Klik <a href=":link">hier</a> om naar deze vakafspraak te gaan.', [
                    'agreement' => $agreement->identifier,
                    'employee' => \App\Http\Traits\PersonTrait::getFullName($employee->getPerson),
                    'link' => route('agreement.view', ['identifier' => $agreement->identifier])
                ])
            !!}
            <br><br><br>
            {{ __('Groeten,') }}
            <br><br>
            {{ __('Studied Webapp') }}
        </td>
    </tr>

@endsection
