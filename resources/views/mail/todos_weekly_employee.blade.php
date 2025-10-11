@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            Hi {{ $user->getPerson->first_name }},
            <br><br>
            {{ __('Dit is jouw wekelijkse overzicht van TODO\'s in de Studied app:') }}
            <br><br>
            @foreach($todos as $todo)
                @include('component.mail-todo')
            @endforeach
            <br><br>
            {{ __('Zorg dat alle TODO items zo snel mogelijk worden opgelost. Mocht je vragen hebben of iets niet duidelijk zijn, laat het dan even weten aan Bas.') }}
            <br><br><br>
            {{ __('Groeten,') }}
            <br><br>
            {{ __('Studied Webapp') }}
        </td>
    </tr>

@endsection
