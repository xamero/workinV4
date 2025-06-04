@props(['id' => null, 'maxWidth' => null, 'placement' => null, 'attributes' => $attributes])

<x-offcanvas :id="$id" :maxWidth="$maxWidth" :placement="$placement" :attributes="$attributes">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        {{ $content }}
    </div>
</x-offcanvas>