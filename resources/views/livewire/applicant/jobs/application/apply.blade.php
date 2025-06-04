<div>
    @if($activeVacancy != null)
   
    <div class="card bg-white">
        <div class="card-header bg-white border-bottom-0">
            <div class="d-flex flex-row-reverse d-md-none">
                <button type="button" class="btn btn-sm" wire:click="$dispatch('removeVacancy')">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="px-1">
                        Back
                    </span>
                </button>
            </div>
            <div class="row row-cols-md-2 row-cols-1 mt-3">
                <div class="col-md-12">
                    @if($activeVacancy->company != null)
                    @if($activeVacancy->company->logo != null)
                    <img src="{{asset('storage/company/'.  $activeVacancy->company->logo)}}" class="mb-3"
                        alt="{{ $activeVacancy->company->name }}" style="max-width: 8rem">
                    @endif
                    @endif
                    <h2 class="">{{$activeVacancy->company->name ?? ''}}</h2>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="card bg-white border-0">
                <div class="card-body ">
                    @if($isApplicationExists)
                    <div class="alert alert-info">
                        @foreach ($isApplicationExists->applicantProfile as $applied)
                        @if($applied->status == 1)
                        <span class="badge bg-success">✓</span>
                        {{$activeVacancy->company->name ?? ''}} has responded to your job application. Please check your
                        registered email.
                        @elseif($applied->status == 2)
                        <span class="badge bg-danger">X</span>
                        {{$activeVacancy->company->name ?? ''}} has declined your job application.
                        @else
                        <span class="badge bg-warning">O</span>
                        {{$activeVacancy->company->name ?? ''}} has yet to respond to your job application.
                        @endif
                        @endforeach
                    </div>
                    @endif
                    <p class="lead">{{$activeVacancy->title}}</p>
                    <p>Location: {{$activeVacancy->location}}</p>
                    @if($activeVacancy->salary_from != null or $activeVacancy->salary_to != null)
                    <p>Salary Range: &#8369;{{ number_format($activeVacancy->salary_from, 2) }}
                        @if($activeVacancy->salary_to != null)
                        - &#8369;{{number_format($activeVacancy->salary_to, 2)}} @endif</p>
                    @endif
                    <p>Type: {{$activeVacancy->job_type}}</p>
                    <p>Total Vacancy: {{$activeVacancy->total_vacancy ?? '1'}}</p>
                </div>
                <div class="my-3">
                    <div class="card-body ">
                        <p>{!! $activeVacancy->details !!}</p>
                    </div>
                </div>
            </div>
            <div class="my-3" style="z-index: 1000">
                @if ($isApplicationExists)
                <a href="{{ route('applicant.application') }}" class="btn btn-secondary shadow float-end">My
                    Application</a>
                @else
                <x-button class="btn-primary shadow float-end" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasApply" wire:click="apply({{ $activeVacancy->id }})">
                   Apply Now 
                    <span wire:loading wire:target="apply({{ $activeVacancy->id }})">
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </x-button>
                @endif
            </div>
        </div>
    </div>
    @endif
    @include('livewire.applicant.jobs.application.offcanvas-apply')
</div>