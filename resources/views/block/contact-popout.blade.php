<div class="button icon">

    <img class="icon" src="/images_app/contact.svg" style="height:28px;padding: 6px 0 6px" onclick="$(this).parent().toggleClass('clicked')">

    <div class="text" style="padding: 5px 0 7px" onclick="$(this).parent().toggleClass('clicked')">Contacteer {{ $user->getPerson->first_name }}</div>

    <div class="contact-popout">

        <div class="contact-item">{{ $user->{\App\Http\Support\Model::$USER_EMAIL} }}</div>

        <div class="contact-item">{{ $user->getPerson->{\App\Http\Support\Model::$PERSON_PHONE} }}</div>

    </div>

</div>
