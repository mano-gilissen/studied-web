<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">

<style>

    * {
        box-sizing:                         border-box;
        margin: 						    0;
        padding: 						    0;
        background-color:                   white;
        color:                              black;
        font-size:                          14px;
        font-family:                        'Source Sans Pro', sans-serif;
        font-weight:                        300;
    }

    .wrap {
        display:                            grid;
        grid-template-columns:              1fr 320px 1fr;
        grid-template-rows:                 120px auto 120px;
        background:                         #E6E6E6;
    }

    .content {
        padding:                            60px 40px;
        background:                         #FFFFFF;
    }

    .button {
        display:                            flex;
        align-items:                        center;
        width:                              fit-content;
        height:                             28px;
        padding:                            0 14px 2px;
        border-radius:                      14px;
        font-weight:                        600;
        background:                         #FFDD34;
        color:                              black;
        border:                             none;
        cursor:                             pointer;
    }

    .seperator-64 {
        height:                             64px;
    }

    .bold {
        font-weight:                        400;
    }

</style>



<div class="wrap">

    <div class="content">

        <div>Hoi {{ $participant->getPerson->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }},<br>

            <br>Er is een <span class="bold">{{ $study->getService->{\App\Http\Support\Model::$SERVICE_NAME} }}</span> voor jou ingepland door
            student-docent <span class="bold">{{ \App\Http\Traits\PersonTrait::getFullName($study->getHost->getPerson) }}</span>. Bekijk deze in
            de Studied app:

        </div>

        <div class="seperator-64"></div>

        <a class="button" href="{{ route('study.view', [$study->{\App\Http\Support\Model::$BASE_KEY}]) }}">Les bekijken</a>

    </div>

</div>
