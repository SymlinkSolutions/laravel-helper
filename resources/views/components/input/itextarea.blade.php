<div class="mt-2 mb-2">
    <div class="form-floating has-validation">
        <textarea class="form-control @if($errors && $errors->has($id)) is-invalid @endif" id="{{ $id }}" name="{{ $id }}" placeholder="{{ $label }}" style="height: 100px">{{ $value }}</textarea>
        <label for="{{ $id }}">{{ $label }}</label>
        @if($errors && $errors->has($id))
            <div class="invalid-feedback">
                {{ $errors->first($id) }}
            </div>
        @endif
    </div>
</div>
