@props(['for'])

@error($for)
<span {{ $attributes->merge(['class' => 'help-block text-danger small']) }} role="alert">
    {{ $message }}
</span>
@enderror