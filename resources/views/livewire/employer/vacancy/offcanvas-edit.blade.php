<div wire:ignore.self class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasEdit"
     aria-labelledby="offcanvasEditLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="offcanvasEditLabel">Vacancy</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($action == 'deleteVacancy')
            @if($applicant_counter > 0)
                    <div class="alert alert-danger">
                       This job vacancy is connected to one or more job applications. It will be moved to your archive instead. Note that changes are irreversible. Scroll down to proceed or click the 'Cancel' button (X) to abort.
                    </div>
            @else
                <div class="alert alert-danger">
                    Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                    down to proceed or click the 'Cancel' button (X) to abort.
                </div>
            @endif
        @endif
        <form wire:submit="{{$action}}">
            <fieldset {{$action == 'deleteVacancy' ? 'disabled':''}}>
                <div class="row mb-3">
                    <x-form-panel-vertical>
                        <x-label class="required">Job Title</x-label>
                        <x-input type="text" wire:model="title"
                                 class="{{$errors->has('title') ? 'is-invalid':''}} "></x-input>
                        @error('title')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical>
                        <x-label class="required">Place of Assignment</x-label>
                        <x-input type="text" wire:model="location"
                                 class="{{$errors->has('location') ? 'is-invalid':''}}"></x-input>
                        @error('location')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col">
                        <x-label class="required">Category (Specialization)</x-label>
                        <select class="form-control {{$errors->has('sub_specialization_id') ? 'is-invalid':''}}"
                                wire:model="sub_specialization_id">
                            <option selected></option>
                            @foreach($subspecializations as $sub)
                                <option value="{{$sub->id}}">{{$sub->name}}</option>
                            @endforeach
                        </select>
                        @error('sub_specialization_id')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <label for="" class="small">Salary Range</label>
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">From</x-label>
                        <x-input type="number" wire:model="salary_from"
                                 class="{{$errors->has('salary_from') ? 'is-invalid':''}}"></x-input>
                        @error('salary_from')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                    <x-form-panel-vertical class="col-md-6">
                        <x-label>To</x-label>
                        <x-input type="number" wire:model="salary_to"
                                 class="{{$errors->has('salary_to') ? 'is-invalid':''}}"></x-input>
                        @error('salary_to')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">Total Vacancies</x-label>
                        <x-input type="number" wire:model="total_vacancy"
                                 class="{{$errors->has('total_vacancy') ? 'is-invalid':''}}"></x-input>
                        @error('total_vacancy')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                    <x-form-panel-vertical class="col-md-6">
                        <x-label class="required">Job Type</x-label>
                        <select wire:model="job_type"
                                class="form-control {{$errors->has('job_type') ? 'is-invalid':''}}">
                            <option value="" selected></option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                        </select>
                        @error('job_type')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3" wire:ignore>
                    <div class="col">
                        <x-label class="required">Details</x-label>
                        <textarea wire:model="details" id="detalye" cols="30" rows="10"
                                  class="form-control {{$errors->has('details') ? 'is-invalid':''}}"></textarea>
                        @error('details')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <x-button class="{{$action == 'deleteVacancy' ? 'btn-danger':'btn-primary'}}">
                <span wire:loading wire:target="{{$action}}">
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Saving...
                </span><span wire:loading.remove wire:target="{{$action}}">
               {{$action == 'deleteVacancy' ? 'Continue':'Save'}}</span></x-button>
                </div>
            </div>
        </form>
    </div>

</div>
