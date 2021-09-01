<div style="padding: 40px;background: lightpink">

    Hallo {{ $person->{\App\Http\Support\Model::$PERSON_FIRST_NAME} }}, dit is een test-email. Jou email adres is {{ $person->getUser->{\App\Http\Support\Model::$USER_EMAIL} }}.

</div>
