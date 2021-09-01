<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
<link href="{{ asset('css/mail.css') }}" rel="stylesheet">



<div class="wrap">

    <div class="wrap">

        <div>Hoi {{ $participant->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }},<br>

            <br>Er is een <span class="bold">{{ $study->getService->{\App\Http\Support\Model::$SERVICE_NAME} }}</span> voor jou ingepland door
            student-docent <span class="bold">{{ \App\Http\Traits\PersonTrait::getFullName($study->getHost->getPerson) }}</span>. Bekijk deze in
            de Studied app:

        </div>

        <div class="seperator-64"></div>

        <a class="button" href="{{ route('study.view', [\App\Http\Support\Model::$BASE_KEY, $study->{\App\Http\Support\Model::$BASE_KEY}]) }}">Les bekijken</a>

    </div>

</div>
