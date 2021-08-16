<div>

    <div class="box-input multiline @error($id) invalid @enderror">

        <textarea
            id                                          = "{{ $id }}"
            type                                        = "{{ $type ?? 'text' }}"
            name                                        = "{{ $id }}"
            placeholder                                 = "{{ $placeholder ?? '' }}"
            value                                       = "{{ $value ?? '' }}"
            autocomplete                                = "{{ $autocomplete ?? 'off' }}"
            data-identifier                             = "{{ $identifier ?? '' }}"
            rows                                        = "{{ $rows ?? 1 }}"

            @isset($required) required @endisset

            @if($locked ?? false) disabled @endif></textarea>

    </div>

    @error($id) <div class="input-invalid">{{ $message }}</div> @enderror

</div>
