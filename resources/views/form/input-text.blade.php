<div class="field">

    <div class="tag">{{ $tag }}</div>

    <div class="box-input">

        <input
            id                                          = "{{ $id }}"
            type                                        = "text"
            name                                        = "{{ $id }}"
            placeholder                                 = "{{ $placeholder ?? '' }}">

        @isset($icon)

            <img class="icon" src="images/{{ $icon }}">

        @endisset

    </div>

</div>
