@props(["name", "label", "id", "value"])

<div>
    <label for="{{ $id }}" class="form-label">
        {{ $label }}
    </label>

    <input {{ $attributes }}
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value ?? "" }}"
        @class(["form-control", "is-invalid" => $errors->has($name)])
    >

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
