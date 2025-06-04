<div wire:ignore.self class="offcanvas w-100 offcanvas-start" tabindex="-1"
     id="offcanvasCompany">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Company Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if($action == 'deleteCompany')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif


        <form wire:submit="{{$action}}">
            <fieldset {{$action == 'deleteCompany' ? 'disabled':''}}>
                @if ($logo)
                    <img src="{{ asset('storage/company/' . $logo) }}" class="img-fluid" style="max-width: 150px">
                @endif
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="img-fluid" style="max-width: 150px">
                @endif
                <div class="row my-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Logo</x-label>
                        <x-input type="file" wire:model="photo"
                                 class="{{$errors->has('logo') ? 'is-invalid':''}}"></x-input>
                        @error('photo')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>

                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Company Name</x-label>
                        <x-input type="text" wire:model="name"
                                 class="{{$errors->has('name') ? 'is-invalid':''}}"></x-input>
                        @error('name')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Address</x-label>
                        <x-input type="text" wire:model="address"
                                 class="{{$errors->has('address') ? 'is-invalid':''}}"></x-input>
                        @error('address')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>

                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical>
                        <x-label class="required">Email</x-label>
                        <x-input type="text" wire:model="email"
                                 class="{{$errors->has('email') ? 'is-invalid':''}}"></x-input>
                        @error('email')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <x-label class="required">Contact Number</x-label>
                        <x-input type="text" wire:model="contact_number"
                                 class="{{$errors->has('contact_number') ? 'is-invalid':''}}"></x-input>
                        @error('contact_number')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3" wire:ignore>
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="">Company Background</x-label>
                        <textarea name="" rows="10" wire:model="company_overview" id="company_overview"
                                  class="form-control {{$errors->has('company_overview') ? 'is-invalid':''}}"></textarea>
                        @error('company_overview')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
            </fieldset>
            <div class="row mb-3">
                <div class="col-md-12">
                    <p>By saving your information, you agree to our <a href="">Privacy Policy</a>.</p>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <x-button class="{{$action == 'confirmDelete' ? 'btn-danger':'btn-primary'}}" type="submit">
                <span wire:loading>
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Processing...
                </span>
                        <span wire:loading.remove>
                {{$action == 'confirmDelete' ? 'Continue':'Save'}}</span></x-button>
                </div>
            </div>


        </form>
    </div>
</div>


