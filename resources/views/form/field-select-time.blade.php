@php $edit = \App\Http\Traits\StudyTrait::isReported($study) @endphp



<div class="field">

    <div class="name">Tijdstip</div>

    <div class="box-select @if($end ?? true) width-third @endif">

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

                    if ($set_study ?? false) {

                        $start                          = $edit ? $study->getReports[0]->start : $study->start;
                        $is_selected                    = App\Http\Support\Format::datetime($start, App\Http\Support\Format::$TIME_SINGLE) == ($hours . ':' . $minutes);

                    }

                @endphp

                <option

                    value = "{{ $hours }}:{{ $minutes }}"

                    @if(($set_study ?? false) && $is_selected) selected @endif>

                    {{ $hours }}:{{ $minutes }}

                </option>

            @endfor

        </select>

    </div>

    @if ($end ?? true)

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

                        if ($set_study ?? false) {

                            if ($edit ?? false) {

                                $end                        = $edit ? $study->getReports[0]->end : $study->end;
                                $is_selected                = App\Http\Support\Format::datetime($end, App\Http\Support\Format::$TIME_SINGLE) == ($hours . ':' . $minutes);

                            } else {

                                $is_selected                = "--:--";

                            }

                        }

                    @endphp

                    <option

                        value = "{{ $hours }}:{{ $minutes }}"

                        @if(($set_study ?? false) && $is_selected) selected @endif>

                        {{ $hours }}:{{ $minutes }}

                    </option>

                @endfor

                @if(($set_study ?? false) && !($edit ?? false) && $is_selected)

                    <option value="00:00" style="display:none" selected>--:--</option>

                @endif

                @if ($edit)

                    <script>

                        select_trigger($(this));

                    </script>

                @endif

            </select>

        </div>

    @endif

</div>
