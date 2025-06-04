<div wire:ignore.self class="offcanvas w-75 offcanvas-start" data-bs-scroll="true" tabindex="-1"
    id="offcanvasPersonalInformation">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Personal Information</h5>
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
        <form wire:submit="savePersonalInformation">
            <div class="mb-3 d-flex justify-content-center">
                <!-- Current Profile Photo -->
                <div class="mt-2">
                    <img src="{{asset('storage/'. Auth::user()->profile_photo_path )}}" class="rounded-circle" height="150px"
                         width="150px">
                </div>

                <!-- New Profile Photo Preview -->
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="rounded-circle" height="150px"
                         width="150px">
                @endif
            </div>
            <div class="mb-3">
                <label for="profile-picture" class="form-label">Choose photo</label>
                <input type="file" class="form-control" name="profile-picture" id="profile-picture"
                       wire:model="photo"/>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <p>Please select a professional looking picture with square dimension (same width and length)
                    </p>
                </div>
            </div>


            <div class="row mb-3">
                <label for="" class="fs-5">Complete Name</label>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">First Name</x-label>
                    <x-input type="text" class="{{ $errors->has('firstname') ? 'is-invalid':'' }}"
                        wire:model="firstname"></x-input>
                    <x-input-error for="firstname" />
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Surname</x-label>
                    <x-input type="text" wire:model="surname" class="{{ $errors->has('surname') ? 'is-invalid':'' }}">
                    </x-input>
                    <x-input-error for="surname" />
                </x-form-panel-vertical>
            </div>
            <div class="row">
                <x-form-panel-vertical class="col-md-6">
                    <x-label>Middle Name</x-label>
                    <x-input type="text" wire:model="midname" class="{{ $errors->has('midname') ? 'is-invalid':'' }}">
                    </x-input>
                    <x-input-error for="midname" />
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-3">
                    <x-label>Suffix</x-label>
                    <x-input type="text" wire:model="suffix" class="{{ $errors->has('suffix') ? 'is-invalid':'' }}">
                    </x-input>
                    <x-input-error for="suffix" />
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <label for="" class="fs-5">Permanent Address</label>
                <x-form-panel-vertical class="col-md-12">
                    <x-label class="required">Province</x-label>
                    <x-input type="text" wire:model="province" class="{{ $errors->has('province') ? 'is-invalid':'' }}">
                    </x-input>
                    <x-input-error for="province" />
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-label class="required">City/Municipality</x-label>
                    <select wire:model="city" wire:change="getBarangay"
                        class="form-control {{ $errors->has('city') ? 'is-invalid':'' }}">
                        <option selected></option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="city" />
                </div>
                <div class="col-md-6">
                    <x-label class="required">Barangay</x-label>
                    <select wire:model="barangay" class="form-control {{ $errors->has('barangay') ? 'is-invalid':'' }}">
                        <option selected></option>
                        @foreach($barangays as $brgy)
                        <option value="{{$brgy->id}}" wire:key="brgy-{{$brgy->id}}">{{$brgy->name}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="barangay" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="fs-5">Current Address </label>
                <p class="small">Leave empty if same as permanent address.</p>
                <x-form-panel-vertical class="col-md-12">
                    <x-label>Province</x-label>
                    <x-input type="text" wire:model="current_province"
                        class="{{ $errors->has('current_province') ? 'is-invalid':'' }}"></x-input>
                    <x-input-error for="current_province" />
                </x-form-panel-vertical>

            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label>City/Municipality</x-label>
                    <x-input type="text" wire:model="current_city"
                        class="{{ $errors->has('current_city') ? 'is-invalid':'' }}"></x-input>
                    <x-input-error for="current_city" />
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label>Barangay</x-label>
                    <x-input type="text" wire:model="current_barangay"
                        class="{{ $errors->has('current_barangay') ? 'is-invalid':'' }}"></x-input>
                    <x-input-error for="current_barangay" />
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <label for="" class="fs-5">Other Information</label>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Birthday</x-label>
                    <x-input type="date" wire:model="birthday" max="{{Carbon\Carbon::now()->toDateString()}}"
                        class="{{ $errors->has('birthday') ? 'is-invalid':'' }}"></x-input>
                    <x-input-error for="birthday" />
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label>Birthplace</x-label>
                    <x-input type="text" wire:model="place_of_birth"
                        class="{{ $errors->has('place_of_birth') ? 'is-invalid':'' }}"></x-input>
                    <x-input-error for="place_of_birth" />
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-label class="required">Sex</x-label>
                    <select wire:model="sex" class="form-control {{ $errors->has('sex') ? 'is-invalid':'' }}">
                        <option selected></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <x-input-error for="sex" />
                </div>
                <x-form-panel-vertical class="col-md-6">
                    <x-label>Religion</x-label>
                    <x-input type="text" wire:model="religion" class="{{ $errors->has('religion') ? 'is-invalid':'' }}">
                    </x-input>
                    <x-input-error for="religion" />
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-label class="required">Civil status</x-label>
                    <select wire:model="civil_status"
                        class="form-control {{ $errors->has('civil_status') ? 'is-invalid':'' }}">
                        <option selected></option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="separated">Separated</option>
                        <option value="leave-in">Leave-In</option>
                    </select>
                    <x-input-error for="civil_status" />
                </div>
                <div class="col-md-6">
                    <x-label class="required">Employment Status</x-label>
                    <select wire:model="employment_status"
                        class="form-control {{ $errors->has('employment_status') ? 'is-invalid':'' }}">
                        <option selected></option>
                        <option value="Wage Employed">Wage Employed</option>
                        <option value="Self Employed">Self Employed</option>
                        <option value="New Entrant/Fresh Graduate">New Entrant/Fresh Graduate</option>
                        <option value="Finish Contract">Finish Contract</option>
                        <option value="Resigned">Resigned</option>
                        <option value="Retired">Retired</option>
                        <option value="Terminated/Laid Off(Local)">Terminated/Laid Off(Local)</option>
                        <option value="Terminated/Laid Off(Abroad)">Terminated/Laid Off(Abroad)</option>
                    </select>
                    <x-input-error for="employment_status" />
                </div>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Contact Number</x-label>
                    <x-input type="number" wire:model="contact_number"
                        class="{{ $errors->has('contact_number') ? 'is-invalid':'' }}"></x-input>
                    <x-input-error for="contact_number" />
                </x-form-panel-vertical>
            </div>
            <div class="mb-3">
                <x-label>Introduction</x-label>
                <textarea class="form-control" rows="3" wire:model="introduction"></textarea>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>By saving your information, you agree to our <a href="">Privacy Policy</a>.</p>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <x-button class=" btn-primary" type="submit">
                <span wire:loading>
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Processing...
                </span>
                        <span wire:loading.remove>Save Personal Information</span></x-button>
                </div>
            </div>
        </form>
    </div>
</div>
