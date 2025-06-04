<div wire:ignore.self class="offcanvas w-100 offcanvas-start" tabindex="-1" id="offcanvasCreateReport">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Submission Calendar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if ($action == 'deleteReport')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down and click 'Continue' to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif

        <form wire:submit="{{ $action }}">
            <fieldset {{ $status == false ? 'disabled' : '' }}>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Title</x-label>
                        <x-input wire:model='title' type="text" class="{{ $errors->has('title') ? 'is-invalid' : '' }}"></x-input>
                        @error('title')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Report Type</x-label>
                        <select wire:model="report_type"
                            class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                            <option value="annual">Annual</option>
                            <option value="semiannual">Semiannual</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="monthly">Monthly</option>
                            <option value="weekly">Weekly</option>
                        </select>
                        @error('type')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <span class="fw-bold">Inclusive Dates</span>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">Start</x-label>
                        <x-input wire:model='start_date' type="date"
                            class="{{ $errors->has('start') ? 'is-invalid' : '' }}"></x-input>
                        @error('start')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">End</x-label>
                        <x-input wire:model='end_date' type="date"
                            class="{{ $errors->has('end') ? 'is-invalid' : '' }}"></x-input>
                        @error('end')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">Due Date</x-label>
                        <x-input wire:model='deadline' type="date" min="{{ \Carbon\Carbon::now()->toDateString() }}"
                            class="{{ $errors->has('deadline') ? 'is-invalid' : '' }}"></x-input>
                        @error('start')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                    @if ($action == 'updateReport')
                        <x-form-panel-vertical class="col-md-6">
                            <x-label>Extend Due Date</x-label>
                            <x-input wire:model='deadline_extension' type="date"
                                class="{{ $errors->has('deadline_extension') ? 'is-invalid' : '' }}"></x-input>
                            @error('deadline_extension')
                                <x-slot name="message">{{ $message }}</x-slot>
                            @enderror
                        </x-form-panel-vertical>
                    @endif
                </div>

                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label>Remarks</x-label>
                        <textarea wire:model='message' id="" cols="30" rows="10"
                            class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}">
                        </textarea>
                        @error('start')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
            </fieldset>
            <div class="row mb-3" {{ $status == false ? 'hidden' : '' }}>
                <div class="col-md-12">
                    <p>By continuing, you confirm that you have read and agree to our <a href="">Privacy
                            Policy.</a>.</p>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12 ">
                    <div class="col d-flex justify-content-end">
                        <x-button class="{{ $action == 'deleteReport' ? 'btn-danger' : 'btn-primary' }}"
                            type="submit">
                            <span wire:loading wire:target="{{ $action }}">
                                <div class="spinner-grow spinner-grow-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                Processing...
                            </span>
                            <span wire:loading.remove wire:target="{{ $action }}">
                                <x-awesome.save></x-awesome.save>
                                {{ $action == 'deleteReport' ? 'Continue' : 'Save' }}</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
