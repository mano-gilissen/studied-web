<div class="field">

    <div class="name">{{ $tag }}</div>

    <div class="switch">

        <div class="button transparent @if(($default ?? false) && ($default == 2)) selected @endif" data-value="2" onclick="switch_click($(this));">Ja</div>

        <div class="button transparent last @if(($default ?? false) && ($default == 1)) selected @endif" data-value="1" onclick="switch_click($(this));">Nee</div>

        @include('form.field-hidden', ['id' => $id, 'value' => $default ?? 0])

    </div>

</div>
