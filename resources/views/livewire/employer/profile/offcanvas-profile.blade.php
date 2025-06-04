<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
     id="offcanvasProfile">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Employer Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form wire:submit="{{$action}}">
            <div class="row mb-3">
                <div class="col-md-3">
                    <x-label class="required">Prefix</x-label>
                    <select wire:model="prefix" class="form-control" required>
                        <option selected></option>
                        <option value="Mr">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mx">Mx</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">First Name</x-label>
                    <x-input type="text" wire:model="firstname"
                             class="{{$errors->has('firstname') ? 'is-invalid':''}}"></x-input>
                    @error('firstname')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Surname</x-label>
                    <x-input type="text" wire:model="surname"
                             class="{{$errors->has('surname') ? 'is-invalid':''}}"></x-input>
                    @error('surname')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>

            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Position</x-label>
                    <x-input type="text" wire:model="position"
                             class="{{$errors->has('position') ? 'is-invalid':''}}"></x-input>
                    @error('position')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Contact Number</x-label>
                    <x-input type="text" wire:model="contact_number"
                             class="{{$errors->has('contact_number') ? 'is-invalid':''}}"></x-input>
                    @error('contact_number')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <p>By saving your information, you agree to our <a href="">Privacy Policy</a>.</p>
                </div>
            </div>
            <x-button class="btn-secondary" type="submit">
                <span wire:loading wire:target="{{$action}}">
                    <div class="spinner-grow spinner-grow-sm" role="status" >
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Processing...
                </span>
                <span wire:loading.remove wire:target="{{$action}}">
                Save</span></x-button>
        </form>
    </div>
</div>

