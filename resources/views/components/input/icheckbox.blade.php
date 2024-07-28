


<div class="form-check">
    <input class="form-check-input @if($errors && $errors->has($id)) is-invalid @endif" type="checkbox" value="{{ $value ?? '1' }}" name="{{ $name }}" id="{{ $name }}">
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
    @if($errors && $errors->has($id))
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @endif
</div>
