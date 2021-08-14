<div class="field">

    <div class="name">Tijdstip</div>

    <div class="box-select width-third">

        <select
            id                                          = "start"
            name                                        = "start"

            @if($trigger ?? false)

                class                                   = "trigger"
                data-trigger                            = "{{ $trigger }}"

            @endif

            >

            @for($i = 420; $i <= 1440; $i += 15)

                @php

                    $hours                              = str_pad((int) ($i / 60), 2, "0", STR_PAD_LEFT);
                    $minutes                            = str_pad($i % 60, 2, "0", STR_PAD_LEFT);

                    $is_selected                        = App\Http\Support\Format::datetime($study->start, App\Http\Support\Format::$TIME_SINGLE) == ($hours . ':' . $minutes);

                @endphp

                <option

                    value = "{{ $hours }}:{{ $minutes }}"

                    @if(($set_study ?? false) && $is_selected) selected @endif>

                    {{ $hours }}:{{ $minutes }}

                </option>

            @endfor

        </select>

    </div>

    <div class="note width-third">tot</div>

    <div class="box-select width-third">

        <select
            id                                          = "end"
            name                                        = "end"

            @if($trigger ?? false)

                class                                   = "trigger"
                data-trigger                            = "{{ $trigger }}"

            @endif

            >

            @for($i = 420; $i <= 1440; $i += 15)

                @php

                    $hours                              = str_pad((int) ($i / 60), 2, "0", STR_PAD_LEFT);
                    $minutes                            = str_pad($i % 60, 2, "0", STR_PAD_LEFT);

                    $is_selected                        = App\Http\Support\Format::datetime($study->end, App\Http\Support\Format::$TIME_SINGLE) == ($hours . ':' . $minutes);

                @endphp

                <option

                    value = "{{ $hours }}:{{ $minutes }}"

                    @if(($set_study ?? false) && $is_selected) selected @endif>

                    {{ $hours }}:{{ $minutes }}

                </option>

            @endfor

        </select>

    </div>

</div>
