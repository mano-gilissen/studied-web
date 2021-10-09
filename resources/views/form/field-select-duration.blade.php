<div class="field">

    <div class="name">Duratie</div>

    <div class="box-clear">

        <div class="duration">

            <div class="dots" id="dots_{{ $id }}">

                @php $dots = $time_available / 15 @endphp

                @for ($i = 0; $i < $dots; $i++)

                    <div class="dot @if($dots > 8) @if($dots > 10) very-narrow @else narrow @endif @endif" id="dot_{{ $id }}_{{ $i }}">

                        <div></div>

                    </div>

                @endfor

            </div>

            <div class="time"></div>

            <input
                id                                          = "_{{ $id }}"
                name                                        = "_{{ $id }}"
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

@if($set ?? false)

    @php $count = $set / 15 @endphp

    <script>

        $(function(){

            console.log('{{ $count }}');

            let dot                                         = $("#dots_{{ $id }} .dot").index(1);

            report_dot_click(dot);
            report_dot_leave(dot);
        });

    </script>

@endif
