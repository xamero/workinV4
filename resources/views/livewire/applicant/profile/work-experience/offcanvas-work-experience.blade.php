<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
     id="offcanvasWorkExperience">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Work
            Experience</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if($action == 'deleteWorkExperience')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down and click continue to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif
        <form wire:submit="{{$action}}">
            <fieldset {{$action == 'deleteWorkExperience' ? 'disabled':''}}>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Company</x-label>
                    <x-input type="text" wire:model="company" class="{{$errors->has('company') ? 'is-invalid':''}}">
                    </x-input>
                    @error('company')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Address</x-label>
                    <x-input type="text" wire:model="address" class="{{$errors->has('address') ? 'is-invalid':''}}">
                    </x-input>
                    @error('address')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>

            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Position</x-label>
                    <x-input type="text" wire:model="position" class="{{$errors->has('position') ? 'is-invalid':''}}">
                    </x-input>
                    @error('position')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>

                <div class="col-md-6">
                    <x-label class="required">Status of Employment</x-label>
                    <select wire:model="status" class="form-control {{$errors->has('status') ? 'is-invalid':''}} ">
                        <option selected></option>
                        <option value="Finished Contract">Finished Contract</option>
                        <option value="Resigned">Resigned</option>
                        <option value="Retired">Retired</option>
                        <option value="Terminated/Laid off">Terminated/Laid Off</option>
                    </select>
                    <x-input-error for="status"/>
                </div>

            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Date Started</x-label>
                    <x-input type="date" wire:model="date_started"
                             class="{{$errors->has('date_started') ? 'is-invalid':''}}"></x-input>
                    @error('date_started')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label>Date Ended</x-label>
                    <x-input type="date" wire:model="date_ended"
                             class="{{$errors->has('date_ended') ? 'is-invalid':''}}"></x-input>
                    @error('date_ended')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="">Job description</x-label>
                    <textarea name="" rows="10" wire:model="job_description"
                              class="form-control {{$errors->has('job_description') ? 'is-invalid':''}}"></textarea>
                    @error('job_description')
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
                    <x-button class="{{$action == 'deleteWorkExperience' ? 'btn-danger':'btn-primary'}}" type="submit" >
                        <span wire:loading wire:target="{{$action}}">
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Processing...
                        </span>
                        <span wire:loading.remove wire:target="{{$action}}">
                   <x-awesome.save></x-awesome.save> {{$action == 'deleteWorkExperience' ? 'Continue':'Save'}}</span>
                    </x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
