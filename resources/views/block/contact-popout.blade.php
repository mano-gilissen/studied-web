<div class="contact-popout">

    <div class="content-item">

        <div class="name">Email</div>

        <div class="value">{{ $user->{\App\Http\Support\Model::$USER_EMAIL} }}</div>

    </div>

    <div class="content-item">

        <div class="name">Telefoon</div>

        <div class="value">{{ $user->getPerson->{\App\Http\Support\Model::$PERSON_PHONE} }}</div>

    </div>

</div>
