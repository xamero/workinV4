<div>
    <div class="container mt-5 py-2">
        <div class="row">
            <div class="col-md-10 col-lg-8">
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
                <div class="card bg-white">
                    <div class="card-body">
                        @if ($profile)
                            <div class="row row-cols-1 row-cols-md-2 g-2 mb-3 bg-white">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <livewire:applicant.profile.profile-picture.index/>
                                    </div>

                                </div>
                                <div class="col-12 col-md-6 col-lg-8">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <h2 class="mb-0">{{$profile->firstname ?? ''}} {{$profile->midname ?? ''}}
                                            {{$profile->surname ??
                                            ''}} {{$profile->suffix ?? ''}}</h2>
                                        <p class="mb-0">{{ $profile->user->email }}</p>
                                        <p class="mb-0">{{ $profile->contact_number }}</p>
                                    </div>
                                </div>
                            </div>
                            @if($profile->introduction != null)
                                <div class="mb-3 bg-white">
                                    <div class="card mb-3 border-0 px-3 pt-3">
                                        <p class="text-justify">
                                            {{$profile->introduction}}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive bg-light px-3 pt-3 mb-3 rounded">
                                <table class="table table-borderless ">
                                    <tr class="">
                                        <td class="text-muted py-0">Permanent Address:</td>
                                        <td class="py-0">{{$profile->barangay->name ?? ''}}, {{$profile->city->name}},
                                            {{$province}}</td>
                                    </tr>
                                    @if($profile->current_city != null)
                                        <tr>
                                            <td class="text-muted py-0">Current Address:</td>
                                            <td class="py-0">{{$profile->current_barangay}}, {{$profile->current_city}}
                                                , {{$profile->current_province}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted py-0">Birthday:</td>
                                        <td class="py-0">{{ Carbon\Carbon::parse($profile->birthday)->format('F d, Y') }}
                                        </td>
                                    </tr>
                                    @if($profile->place_of_birth != null)
                                        <tr>
                                            <td class="text-muted py-0">Place of birth:</td>
                                            <td class="py-0">{{$profile->place_of_birth}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted py-0">Sex:</td>
                                        <td class="py-0">{{ucwords($profile->sex) }}</td>
                                    </tr>
                                    @if($profile->religion != null)
                                        <tr>
                                            <td class="text-muted py-0">Religion:</td>
                                            <td class="py-0">{{$profile->religion}}</td>
                                        </tr>
                                    @endif
                                    @if($profile->civil_status != null)
                                        <tr>
                                            <td class="text-muted py-0">Civil Status:</td>
                                            <td class="py-0">{{$profile->civil_status}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted py-0">Employment Status:</td>
                                        <td class="py-0">{{$profile->employment_status}}</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <p>Your personal information is blank.</p>
                        @endif
                        <button class="btn btn-sm btn-lite-secondary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasPersonalInformation" aria-controls="offcanvasWithBothOptions">
                            <x-awesome.edit></x-awesome.edit>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.applicant.profile.personal-information.offcanvas-personal-information')

    @if ($profile_id)
        <livewire:applicant.profile.work-experience :id="$profile_id"/>
        <livewire:applicant.profile.educational-background.index :id="$profile_id"/>
        <livewire:applicant.profile.license-eligibilities.index :id="$profile_id"/>
        <livewire:applicant.profile.training.index :id="$profile_id"/>
        <livewire:applicant.profile.specialization.index :id="$profile_id"/>
    @endif

</div>
