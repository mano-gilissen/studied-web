<div>

    <div class="box-input @error($id) invalid @enderror" @isset($id_box) id="{{ $id_box }}" @endisset @if($locked ?? false) disabled @endif>

        <input
            id                                          = "{{ $id }}"
            type                                        = "{{ $type ?? 'text' }}"
            name                                        = "{{ $id }}"
            placeholder                                 = "{{ $placeholder ?? '' }}"
            value                                       = "{{ $value ?? '' }}"
            autocomplete                                = "{{ $autocomplete ?? 'off' }}"
            data-identifier                             = "{{ $identifier ?? '' }}"

            @isset($required) required @endisset>

        @isset($icon) <img class="icon" src="/images/{{ $icon }}"> @endisset

    </div>

    <div class="autocomplete"></div>

    @error($id) <div class="input-invalid">{{ $message }}</div> @enderror

    @if($uses_id ?? false)

        <input
            id                                          = "_{{ $id }}"
            name                                        = "_{{ $id }}"
            type                                        = "hidden">

    @endif

</div>

@if($data ?? false)

    <script>

        autocomplete(

            /* Input field ID */
            document.getElementById('{{ $id }}'),

            /* Autocomplete data */
            JSON.parse('{!! ${'ac_data_' . $id} !!}'),

            /* Autocomplete additional data */
            @if($additional ?? false) JSON.parse('{!! ${'ac_additional_' . $id} !!}'), @else null, @endif

            /* Reject non-autocomplete input */
            '{{ $reject_other ?? false }}',

            /* Show all autocomplete values on focus */
            '{{ $show_all ?? false }}',

            /* Does the data contain database ID keys */
            '{{ $uses_id ?? false }}',

            /* Set a default value by ID */
            '{{ $set_id ?? false }}',

            /* Lock the input field form user input */
            '{{ $locked ?? false }}',

            /* Which function needs to be called after setting an ID */
            '{{ $trigger ?? false }}',

            /* Is the input field part of a form */
            '{{ $form ?? true }}'

        );

    </script>

@endif
