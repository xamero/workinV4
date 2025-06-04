@props(['value'])

<label {{ $attributes->merge(['class' => 'fw-bold small']) }} >
    {{ $value ?? $slot }}
</label>
