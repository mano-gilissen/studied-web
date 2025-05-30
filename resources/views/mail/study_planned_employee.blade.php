@extends('mail.template')

@section('body')

    <tr>
        <td style="padding: 0 0 35px 0;">
            <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                {{ __('Beste :first_name', [
                    'first_name' => $employee->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME}
                ]) }},
            </p><br>

            @if(\App\Http\Traits\StudyTrait::hasLink($study))
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {{ __(':full_name heeft een les :subject_name met jou en :participants_text ingepland op :date van :time. :link Kom op tijd en zorg ervoor dat de leerling(en) weet wat hij moet meenemen en voorbereiden.', [
                        'full_name' => \App\Http\Traits\PersonTrait::getFullName(Auth::user()->getPerson),
                        'subject_name' => strtolower(\App\Http\Traits\StudyTrait::getSubject($study)->{\App\Http\Support\Model::$SUBJECT_NAME}),
                        'participants_text' => \App\Http\Traits\StudyTrait::getParticipantsText($study),
                        'date' => strtolower(\App\Http\Support\Format::datetime($study->start, \App\Http\Support\Format::$DATETIME_SINGLE)),
                        'time' => \App\Http\Traits\StudyTrait::getTimeText($study, true),
                        'link' => '<a href="' . $study->{\App\Http\Support\Model::$STUDY_LINK} . '">' . $study->{\App\Http\Support\Model::$STUDY_LINK} . '</a>'
                    ]) }}
                </p>
            @else
                <p style="margin: 0; font-size: 13px; line-height: 22.8px;">
                    {{ __(':full_name heeft een les :subject_name met jou en :participants_text ingepland op :date van :time. De locatie is: :location. Kom op tijd en zorg ervoor dat de leerling(en) weet wat hij moet meenemen en voorbereiden.', [
                        'full_name' => \App\Http\Traits\PersonTrait::getFullName(Auth::user()->getPerson),
                        'subject_name' => strtolower(\App\Http\Traits\StudyTrait::getSubject($study)->{\App\Http\Support\Model::$SUBJECT_NAME}),
                        'participants_text' => \App\Http\Traits\StudyTrait::getParticipantsText($study),
                        'date' => strtolower(\App\Http\Support\Format::datetime($study->start, \App\Http\Support\Format::$DATETIME_SINGLE)),
                        'time' => \App\Http\Traits\StudyTrait::getTimeText($study, true),
                        'location' => $study->{\App\Http\Support\Model::$STUDY_LOCATION_TEXT}
                    ]) }}
                </p>
            @endif
            <br>
            {{ __('Je kunt de lesgegevens bekijken in onze webapp. Mocht je vragen hebben, aarzel dan niet contact met ons op te nemen!') }}
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ route('study.view', [$study->{\App\Http\Support\Model::$BASE_KEY}]) }}" style="color: black; font-size: 14px; line-height: 14px; background-color: #FFDD34; display: block; text-align: center; padding: 25px; text-decoration: none; border-radius: 10px; font-weight: bold;">
                {{ __('Les bekijken') }}
            </a>
        </td>
    </tr>

@endsection
