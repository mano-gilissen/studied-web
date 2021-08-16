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

            @isset($required) required @endisset

            @if($locked ?? false) disabled @endif/>

    </div>

    @error($id) <div class="input-invalid">{{ $message }}</div> @enderror

</div>
