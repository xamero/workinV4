@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-xl-5">
            {{ $content }}
        </div>
        <div class="modal-footer bg-light">
            {{ $footer }}
        </div>
    </div>
</x-modal>
