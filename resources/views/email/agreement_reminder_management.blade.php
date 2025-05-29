@extends('template.email')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            {{ __('Hi team,') }}
            <br><br>
            {!! 'Vakafspraak ' . $this->agreement->identifier . ' (losse lessen) van '
            . PersonTrait::getFullName($this->employee->getPerson) . ' heeft na 7 dagen nog geen lessen ingepland. '
            . 'Klik <a href="' .  route('agreement.view', ['identifier' => $this->agreement->identifier]) . '">hier</a> om naar deze vakafspraak te gaan.' !!}
            <br><br><br>
            {{ __('Groeten,') }}
            <br><br>
            {{ __('Studied Webapp') }}
        </td>
    </tr>

@endsection
