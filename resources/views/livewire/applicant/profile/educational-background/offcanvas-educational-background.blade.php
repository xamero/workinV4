<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
     id="offcanvasEducationalBackground">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 ">Educational Background</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if($action == 'deleteEducationalBackground')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down and click continue to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif
        <form wire:submit="{{$action}}">
            <fieldset {{$action == 'deleteEducationalBackground' ? 'disabled':''}}>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">School/Institution</x-label>
                        <x-input type="text" wire:model="school" class="{{$errors->has('school') ? 'is-invalid':''}}">
                        </x-input>
                        @error('school')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="">Course</x-label>
                        <x-input type="text" wire:model="course" class="{{$errors->has('course') ? 'is-invalid':''}}">
                        </x-input>
                        @error('course')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>

                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <x-label class="required">Level</x-label>
                        <select wire:model="level" class="form-control {{$errors->has('level') ? 'is-invalid':''}}">
                            <option selected></option>
                            <option value="1">Elementary</option>
                            <option value="2">High School</option>
                            <option value="3">Technical Vocational</option>
                            <option value="4">College</option>
                            <option value="5">Post-Graduate</option>
                        </select>
                        <x-input-error for="level"/>
                    </div>
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">Year Graduated</x-label>
                        <x-input type="number" wire:model="year_graduated"
                                 class="{{$errors->has('year_graduated') ? 'is-invalid':''}}"></x-input>
                        @error('year_graduated')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="">Highlights (Awards received etc.)</x-label>
                        <textarea name="" rows="10" wire:model="highlights"
                                  class="form-control {{$errors->has('highlights') ? 'is-invalid':''}}"></textarea>
                        @error('highlights')
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
                    <x-button class="{{$action == 'deleteEducationalBackground' ? 'btn-danger':'btn-primary'}}" type="submit">
                        <span wire:loading wire:target="{{$action}}">
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Processing...
                        </span>
                        <span wire:loading.remove wire:target="{{$action}}">
                   <x-awesome.save></x-awesome.save> {{$action == 'deleteEducationalBackground' ? 'Continue':'Save'}}</span>
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</div>
