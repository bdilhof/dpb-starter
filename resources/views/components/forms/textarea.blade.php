@props(["name","label", "id", "value"])

<div>
    <label for="{{ $id }}" class="form-label">
        {{ $label }}
    </label>

    <textarea {{ $attributes }}
        @class(["form-control", "is-invalid" => $errors->has($name)])
        id="{{ $id }}"
        name="{{ $name }}"
    >{{ $value }}</textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
