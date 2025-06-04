<div wire:ignore.self class="offcanvas w-100 offcanvas-start" tabindex="-1" id="offcanvasSubmitReport">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Submit Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if ($activeReport != null)
            <div class="alert alert-danger">
                Warning: A previous submission exists. Uploading a new file will permanently overwrite it.
            </div>
        @endif

        <form wire:submit="{{ $action }}">
            <fieldset {{ $status == false ? 'disabled' : '' }}>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Report</x-label>
                        <select wire:model="report_details" class="form-control"
                            class="{{ $errors->has('type') ? 'is-invalid' : '' }}">
                            <option value="" selected></option>
                            @foreach ($reports as $report)
                                <option value="{{ $report->id }}">{{ $report->title }}</option>
                            @endforeach
                        </select>
                        @error('report_details')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                @if ($activeReport != null)
                    <div class="row">
                        <x-form-panel-vertical class="col-md-12">
                            <x-label>Details</x-label>
                            <p>{{ $activeReport->message }}</p>
                        </x-form-panel-vertical>
                    </div>
                    <div class="row mb-3">
                        <x-form-panel-vertical class="col-md-6">
                            <x-label>Inclusive Date</x-label>
                            <p>{{ \Carbon\Carbon::parse($activeReport->start_date)->format('M. d, Y') }} -
                                {{ \Carbon\Carbon::parse($activeReport->end_date)->format('M. d, Y') }}</p>
                        </x-form-panel-vertical>
                        <x-form-panel-vertical class="col-md-6">
                            <x-label>Due Date</x-label>
                            <p>{{ \Carbon\Carbon::parse($activeReport->deadline)->format('M. d, Y') }}</p>
                        </x-form-panel-vertical>
                    </div>
                    <div class="row mb-3">
                        <x-form-panel-vertical class="col-md-6">
                            <x-label>Your Date of Submission</x-label>
                            <p class="mb-0">{{ \Carbon\Carbon::parse(now())->format('M. d, Y') }}</p>
                            @if ($this->isLate)
                                <span class="badge bg-danger">Late Submission</span>
                            @else
                                <span class="badge bg-success">On Time Submission</span>
                            @endif
                        </x-form-panel-vertical>
                    </div>
                @endif
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Upload File</x-label>
                        <input type="file" wire:model="file_upload"
                            class="form-control {{ $errors->has('file_upload') ? 'is-invalid' : '' }}"
                            accept=".xlsx,.xls">
                        @error('file_upload')
                            <x-slot name="message">{{ $message }}</x-slot>
                        @enderror
                        <div wire:loading wire:target="file_upload" class="text-info mt-2">
                            Checking your file. Please wait a few seconds...
                        </div>
                    </x-form-panel-vertical>
                </div>
            </fieldset>
            <div class="row mb-3" {{ $status == false ? 'hidden' : '' }}>
                <div class="col-md-12">
                    <p>By continuing, you confirm that you have read and agree to our <a href="">Privacy
                            Policy.</a>.</p>
                </div>
            </div>
            <div class="row" {{ $status == false ? 'hidden' : '' }}>
                <div class="col-md-12 ">
                    <div class="col d-flex justify-content-end">
                        <x-button class="{{ $action == 'deleteActivity' ? 'btn-danger' : 'btn-primary' }}"
                            type="submit" wire:loading.attr="disabled" wire:target="file_upload" :disabled="$errors->has('file_upload') || !$file_upload">
                            <span wire:loading wire:target="{{ $action }}">
                                <div class="spinner-grow spinner-grow-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                Processing...
                            </span>
                            <span wire:loading.remove wire:target="{{ $action }}">
                                <x-awesome.save></x-awesome.save>
                                {{ $action == 'deleteActivity' ? 'Continue' : 'Save' }}</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
