<div class="field">

    <div class="name">Duratie</div>

    <div class="box-clear">

        <div class="duration">

            <div class="dots" id="{{ $id }}">

                @for ($i = 0; $i < ($available / 15); $i++)

                    <div class="dot" id="dot_{{ $id }}_{{ $i }}">

                        <div></div>

                    </div>

                @endfor

            </div>

            <div class="time">0 min</div>

            <input
                id                                          = "_duration_{{ $id }}"
                name                                        = "_duration_{{ $id }}"
                type                                        = "hidden">

        </div>

    </div>

</div>
