<div>

    <div class="box-input @error($id) invalid @enderror" @isset($id_box) id="{{ $id_box }}" @endisset >

        <div class="autocomplete">

            <input
                id                                          = "{{ $id }}"
                type                                        = "{{ $type ?? 'text' }}"
                name                                        = "{{ $id }}"
                placeholder                                 = "{{ $placeholder ?? '' }}"
                value                                       = "{{ $value ?? '' }}"
                autocomplete                                = "{{ $autocomplete ?? 'off' }}"

                @isset($required) required @endisset >

            @isset($icon) <img class="icon" src="images/{{ $icon }}"> @endisset

        </div>

    </div>

    @error($id) <div class="input-invalid">{{ $message }}</div> @enderror

</div>

@isset($data)

    <script>

        console.log({{ $autocomplete_data_vak }});

    </script>

@endisset
