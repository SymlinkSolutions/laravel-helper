


<div class="row">
    <div class="col-4 d-flex align-items-center">
        <label class="mb-0 form-label" for="{{ $name }}">
            {{ $label }}
        </label>
    </div>
    <div class="col-4">
        <input type="color" class="form-control form-control-color @if($errors && $errors->has($id)) is-invalid @endif" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" title="{{ $title }}">
        @if($errors && $errors->has($id))
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @endif
    </div>
</div>

