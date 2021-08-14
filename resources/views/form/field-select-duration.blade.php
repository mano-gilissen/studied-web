<div class="field">

    <div class="name">Duratie</div>

    <div class="box-clear">

        <div class="duration">

            <div class="dots" id="dots_{{ $id }}">

                @for ($i = 0; $i < ($time_available / 15); $i++)

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

        $(function(){

            let dot                                         = $("#dots_{{ $id }} .dot").last();

            report_dot_click(dot);
            report_dot_leave(dot);
        });

    </script>

@endif
