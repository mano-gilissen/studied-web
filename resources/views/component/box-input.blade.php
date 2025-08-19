<div @isset($id_outer) id="{{ $id_outer }}" @endisset @isset($style_outer) style="{{ $style_outer }}" @endisset>

    <div class="box-input @error($id) invalid @enderror @isset($size) {{ $size }} @endisset" @isset($id_box) id="{{ $id_box }}" @endisset>

        <input
            id                                          = "{{ $id }}"
            type                                        = "{{ $type ?? 'text' }}"
            name                                        = "{{ $id }}"
            placeholder                                 = "{{ $placeholder ?? '' }}"
            value                                       = "{{ $value ?? '' }}"
            autocomplete                                = "{{ $autocomplete ?? 'off' }}"
            data-identifier                             = "{{ $identifier ?? '' }}"

            @if($max ?? false) maxlength = "{{ $max }}" @endif

            @isset($required) required @endisset

            @if($locked ?? false) disabled @endif

            @if(!($keyboard ?? true)) inputmode = "none" readonly @endif>

        @isset($icon) <img class="icon" src="/images_app/{{ $icon }}"> @endisset

    </div>

    <div class="autocomplete"></div>

    @error($id) <div class="input-invalid">{{ $message }}</div> @enderror

    @if($uses_id ?? false)

        <input
            id                                          = "_{{ $id }}"
            name                                        = "_{{ $id }}"
            inputmode                                   = "none"
            type                                        = "hidden"
            readonly>

    @endif

</div>

@if($data ?? false)

    <script>

        autocomplete(

            /* Input field ID */
            $('#{{ str_replace('.', '\\\\.', $id) }}'),

            /* Autocomplete data */
            JSON.parse('{!! ${'ac_data_' . ($ac_data ?? false ? $ac_data : $id)} !!}'),

            /* Autocomplete additional data */
            @if($additional ?? false) JSON.parse('{!! ${'ac_additional_' . ($ac_data ?? false ? $ac_data : $id)} !!}'), @else null, @endif

            /* Reject non-autocomplete input */
            '{{ $reject_other ?? false }}',

            /* Show all autocomplete values on focus */
            '{{ $show_all ?? false }}',

            /* Show all values on focus regardless of input */
            '{{ $show_always ?? false }}',

            /* Does the data contain database ID keys */
            '{{ $uses_id ?? false }}',

            /* Set a default value by ID */
            '{{ $set_id ?? -1 }}',

            /* Lock the input field form user input */
            '{{ $locked ?? false }}',

            /* Which function needs to be called after setting an ID */
            '{{ $trigger ?? false }}',

            /* Is the input field part of a form */
            '{{ $form ?? true }}'

        );

    </script>

@endif
