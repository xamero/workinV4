<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <x-action-message on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="mb-3" x-data="{photoName: null, photoPreview: null}">
            <!-- Profile Photo File Input -->
            <input type="file" hidden wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2">
                <img src="{{asset('storage/' . $this->user->profile_photo_path )    }}" class="rounded-circle" height="80px" width="80px">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="rounded-circle" height="80px"
                         width="80px">
                @endif
            </div>

            <x-button class="mt-2 me-2 btn-lite-secondary" type="button" >
                {{ __('Select A New Photo') }}
            </x-button>

            @if ($this->user->profile_photo_path)
            <x-button type="button" class="mt-2 btn-lite-danger" wire:click="deleteProfilePhoto">
                <div wire:loading wire:target="deleteProfilePhoto" class="spinner-border spinner-border-sm"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Remove Photo') }}
            </x-button>
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>
        @endif

        <div class="w-md-75">
            <!-- Name -->
            <div class="mb-3">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                    wire:model.defer="state.name" autocomplete="name" />
                <x-input-error for="name" />
            </div>

            <!-- Email -->
            <div class="mb-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    wire:model.defer="state.email" />
                <x-input-error for="email" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="d-flex align-items-baseline">
            <x-button class="btn-secondary">
                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <x-awesome.save></x-awesome.save> Save
            </x-button>
        </div>
    </x-slot>
</x-form-section>
