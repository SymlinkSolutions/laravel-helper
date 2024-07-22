@props([
    'label' => '',
    'id' => '',
    'value' => '',
    'type' => 'text',
    'error' => false,
    'errorMessage' => '',
])

<div class="mt-2 mb-2">
    <div class="form-floating has-validation">
        <input 
            {{ $attributes->merge(['class' => 'form-control' . ($error ? ' is-invalid' : '')]) }} 
            type="{{ $type }}" 
            id="{{ $id }}" 
            name="{{ $id }}" 
            placeholder="{{ $label }}" 
            value="{{ $value }}"
        >
        <label for="{{ $id }}">{{ $label }}</label>
        @if ($error)
            <div class="invalid-feedback">
                {{ $errorMessage }}
            </div>
        @endif
    </div>
</div>
