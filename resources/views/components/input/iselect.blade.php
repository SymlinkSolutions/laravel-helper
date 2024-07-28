

<div class="mt-2 mb-2">
    <div class="form-floating has-validation">
        <select class="form-select @if($errors && $errors->has($id)) is-invalid @endif" name="{{ $id }}"
            id="{{ $id }}" aria-label="{{ $label }}">
            {{ $slot }}
        </select>
        <label for="{{ $id }}">{{ $label }}</label>
        @if($errors && $errors->has($id))
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
