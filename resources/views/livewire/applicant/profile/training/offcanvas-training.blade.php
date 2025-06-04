<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
    id="offcanvasTraining">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Trainings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if($action == 'deleteTraining')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down and click continue to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif
        <form wire:submit="{{$action}}">
            <fieldset {{$action == 'deleteTraining' ? 'disabled':''}}>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Training Name</x-label>
                    <x-input type="text" wire:model="name" class="{{$errors->has('name') ? 'is-invalid':''}}"></x-input>
                    @error('name')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Date of start</x-label>
                    <x-input type="date" wire:model="date_start"
                        class="{{$errors->has('date_start') ? 'is-invalid':''}}"></x-input>
                    @error('date_start')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>

                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Date of end</x-label>
                    <x-input type="date" wire:model="date_end" class="{{$errors->has('date_end') ? 'is-invalid':''}}">
                    </x-input>
                    @error('date_end')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Institution</x-label>
                    <x-input type="text" wire:model="institution"
                        class="{{$errors->has('institution') ? 'is-invalid':''}}">
                    </x-input>
                    @error('institution')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Certificate</x-label>
                    <x-input type="text" wire:model="certificate"
                        class="{{$errors->has('certificate') ? 'is-invalid':''}}">
                    </x-input>
                    @error('certificate')
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
                        <x-button class="{{$action == 'deleteTraining' ? 'btn-danger':'btn-primary'}}" type="submit" >
                        <span wire:loading wire:target="{{$action}}">
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Processing...
                        </span>
                            <span wire:loading.remove wire:target="{{$action}}">
                   <x-awesome.save></x-awesome.save> {{$action == 'deleteTraining' ? 'Continue':'Save'}}</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
