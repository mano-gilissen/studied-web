<div class="field">

    <div class="name">{{ $tag }}</div>

    <div class="switch">

        <div class="button transparent" data-value="2">Ja</div>

        <div class="button transparent last" data-value="1">Nee</div>

        @include('form.field-hidden', ['id' => $id])

    </div>

</div>
