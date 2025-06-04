<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
    id="offcanvasLicensesEligibilities">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Licenses and
            Eligibilities</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if($action == 'deleteLicense')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down and click continue to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif
        <form wire:submit="{{$action}}">
            <fieldset {{$action == 'deleteLicense' ? 'disabled':''}}>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">License or Eligibility Name</x-label>
                    <x-input type="text" wire:model="name" class="{{$errors->has('name') ? 'is-invalid':''}}"></x-input>
                    @error('name')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Issuing Organization</x-label>
                    <x-input type="text" wire:model="issuer" class="{{$errors->has('issuer') ? 'is-invalid':''}}">
                    </x-input>
                    @error('issuer')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label>Date of Issuance</x-label>
                    <x-input type="date" wire:model="date_of_issuance"
                        class="{{$errors->has('date_of_issuance') ? 'is-invalid':''}}"></x-input>
                    @error('date_of_issuance')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>

                <div class="col-md-6">
                    <x-label>Date of Expiration</x-label>
                    <x-input type="date" wire:model="date_of_expiration"
                        class="{{$errors->has('date_of_expiration') ? 'is-invalid':''}}"></x-input>
                    @error('date_of_expiration')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </div>

            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="">Description</x-label>
                    <textarea name="" rows="10" wire:model="description"
                        class="form-control {{$errors->has('description') ? 'is-invalid':''}}"></textarea>
                    @error('description')
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
                <div class="col-md-12 ">
                    <div class="col d-flex justify-content-end">
                        <x-button class="{{$action == 'deleteLicense' ? 'btn-danger':'btn-primary'}}" type="submit" >
                        <span wire:loading wire:target="{{$action}}">
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Processing...
                        </span>
                            <span wire:loading.remove wire:target="{{$action}}">
                   <x-awesome.save></x-awesome.save> {{$action == 'deleteLicense' ? 'Continue':'Save'}}</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
