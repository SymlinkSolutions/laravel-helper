@props([
    'label' => 'Save Changes',
    'icon' => 'bi bi-floppy',
])


<button type="submit" id="submit" {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
    <i class="{{ $icon }}"></i>
    {{ $label }}
</button>