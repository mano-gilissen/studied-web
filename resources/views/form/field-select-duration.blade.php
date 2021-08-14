<div class="field">

    <div class="name">Duratie</div>

    <div class="box-clear">

        <div class="duration">

            <div class="dots" id="dots_{{ $id }}">

                @for ($i = 0; $i < ($available / 15); $i++)

                    <div class="dot" id="dot_{{ $id }}_{{ $i }}">

                        <div></div>

                    </div>

                @endfor

            </div>

            <div class="time"></div>

            <input
                id                                          = "_duration_{{ $id }}"
                name                                        = "_duration_{{ $id }}"
                type                                        = "hidden">

        </div>

    </div>

</div>

@if($set_max ?? false)

    <script>

        dot_click($("#dots_{{ $id }} .dot").last());

    </script>

@endif
