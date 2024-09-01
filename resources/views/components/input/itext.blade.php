<div class="mt-2 mb-2">
    <div class="input-group">
        @if($prepend)
            <!-- Prepend Section -->
            <span class="input-group-text">{{ $prepend }}</span>
        @endif

        <div class="form-floating has-validation">
            <input
                class='form-control @if($errors && $errors->has($id)) is-invalid @endif'
                type="{{ $type }}"
                id="{{ $id }}"
                name="{{ $id }}"
                placeholder="{{ $label }}"
                value="{{ $value }}"
                {{ $attributes }}
            />
            <label for="{{ $id }}">{{ $label }}</label>

            @if($errors && $errors->has($id))
                <div class="invalid-feedback">
                    {{ $errors->first($id) }}
                </div>
            @endif
        </div>
    </div>
</div>
