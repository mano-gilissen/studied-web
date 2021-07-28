<div>

    <div class="box-input @error($id) invalid @enderror" @isset($id_box) id="{{ $id_box }}" @endisset >

        <input
            id                                          = "{{ $id }}"
            type                                        = "{{ $type ?? 'text' }}"
            name                                        = "{{ $id }}"
            placeholder                                 = "{{ $placeholder ?? '' }}"
            value                                       = "{{ $value ?? '' }}"
            autocomplete                                = "{{ $autocomplete ?? 'off' }}"

            @isset($required) required @endisset >

        @isset($icon) <img class="icon" src="/images/{{ $icon }}"> @endisset

    </div>

    <div class="autocomplete"></div>

    @error($id) <div class="input-invalid">{{ $message }}</div> @enderror

</div>

@if($data ?? false)

    <script>

        autocomplete(

            /* Input field ID */
            document.getElementById('{{ $id }}'),

            /* Autocomplete data */
            '{{ ${'ac_data_'.$id} }}'.split('::'),

            /* Autocomplete additional data */
            @if($subvalues ?? false)

                '{{ ${'ac_additional_'.$id} }}'.split('::'),

            @else

                null,

            @endif

            /* Reject non-autocomplete input */
            '{{ $reject_other ?? false }}',

            /* Show all autocomplete values on focus */
            '{{ $show_all ?? false }}'
        );

    </script>

@endif
