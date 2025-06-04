@props(['id', 'maxWidth', 'placement'])

@php
$id = $id ?? md5($attributes->wire('model'));

$placement = [
'top' => ' offcanvas-top',
'left' => ' offcanvas-start',
'right' => ' offcanvas-end',
'bottom' => ' offcanvas-bottom',
][$placement ?? 'left'];

$maxWidth = [
'none' => ' offcanvas',
'sm' => ' offcanvas-sm',
'md' => ' offcanvas-md',
'lg' => ' offcanvas-lg',
'xl' => ' offcanvas-xl',
][$maxWidth ?? 'none'];
@endphp

<!-- Modal -->
<div x-data="{
        show: @entangle($attributes->wire('model')),
    }" x-init="() => {

        let el = document.querySelector('#offcanvas-id-{{ $id }}')

        let bsOffcanvas  = new bootstrap.Offcanvas(el);

        $watch('show', value => {
            if (value) {
                bsOffcanvas.show()
            } else {
                bsOffcanvas.hide()
            }
        });

        el.addEventListener('hide.bs.offcanvas', function (event) {
            show = false
        })
    }" wire:ignore.self class="{{ $maxWidth }}{{ $placement }}" tabindex="-1" id="offcanvas-id-{{ $id }}"
    aria-labelledby="offcanvas-id-{{ $id }}" aria-hidden="true" x-ref="offcanvas-id-{{ $id }}" {{ $attributes }}>
    {{ $slot }}
</div>