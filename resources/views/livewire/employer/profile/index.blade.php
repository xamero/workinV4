<div class="card p-3 mb-3 bg-white h-100">
    <div class="card-body">
        @if ($profile != null)
            <p class="lead mb-0">{{ $profile->prefix }} {{ $profile->firstname }} {{ $profile->surname }}</p>
            <p class="mb-0">{{ $profile->position }}</p>
            <p class="mb-0">{{ $profile->contact_number }}</p>
            <p class="">Profile ID: {{ $profile->employer_id }}</p>
        @else
            <p>Looks like you haven't set your employer profile.</p>
        @endif
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile"
            wire:click="addProfile">
            Update employer profile
        </button>
    </div>
    @include('livewire.employer.profile.offcanvas-profile')
</div>
