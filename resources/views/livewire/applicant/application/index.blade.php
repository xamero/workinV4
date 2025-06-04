<div>
    <div class="container mt-5 py-2">
        @if ($applicantProfile)
            <div class="row g-2">
                @if ($applicantProfile->application->count() > 0)
                    <p class="text-muted">Here's a list of job applications you sent for the previous days.</p>
                    <div class="col-md-4 d-none d-md-block">
                        @foreach ($applicantProfile->application as $application)
                            <div class="card mb-3 pointer bg-white rounded"
                                wire:click="getApplicationDetail({{ $application->id }})">
                                <div wire:loading wire:target="getApplicationDetail({{ $application->id }})"
                                    class="loading-bar rounded-3"></div>
                                @if ($applicationDetail)
                                    @if ($applicationDetail->id == $application->id)
                                        <div class="rounded-3 static-bar" wire:loading.remove
                                            wire:target="getApplicationDetail({{ $application->id }})"></div>
                                    @endif
                                @endif
                                <div class="card-body">
                                    <h4 class="card-title">{{ $application->company->name }}</h4>
                                    <p class="card-text">Title: {{ $application->title }}</p>
                                    {{-- <p class="card-text">{{ Str::limit($application->details, 50) }}</p> --}}
                                    @if ($application->subSpecialization)
                                        <p>Job type: {{ $application->subSpecialization->name }}</p>
                                    @endif
                                    <p>Applied:
                                        {{ Carbon\Carbon::parse($application->pivot->applied_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-8 d-none d-md-block">
                        @if ($applicationDetail)
                            <div class="sticky">
                                <livewire:applicant.application.application-detail :id="$applicationDetail->id"
                                    :key="$applicationDetail->id" />
                            </div>
                        @else
                            <div class="d-flex flex-column justify-content-center align-items-center m-5">
                                {{--                        <div><i class="fa-solid fa-magnifying-glass fa-10x"></i></div> --}}
                                <p>Select from your list on the left or start applying for jobs that you are interested
                                    in!</p>
                                <a href="{{ route('jobs.search.index') }}" class="btn btn-primary">Apply here</a>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 d-md-none">
                        @if ($applicationDetail)
                            <livewire:applicant.application.application-detail :id="$applicationDetail->id" :key="$applicationDetail->id" />
                        @else
                            @foreach ($applicantProfile->application as $application)
                                <div class="card mb-3" wire:click="getApplicationDetail({{ $application->id }})">

                                    <div class="card-body">
                                        <h4 class="card-title">{{ $application->company->name }}</h4>
                                        <p class="card-text">Title: {{ $application->title }}</p>
                                        {{-- <p class="card-text">{{ Str::limit($application->details, 50) }}</p> --}}
                                        @if ($application->subSpecialization)
                                            <p>Job type: {{ $application->subSpecialization->name }}</p>
                                        @endif
                                        <p>Applied:
                                            {{ Carbon\Carbon::parse($application->pivot->applied_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @else
                    <div class="d-flex flex-column justify-content-center align-items-center m-5">
                        <div><i class="fa-solid fa-magnifying-glass fa-10x"></i></div>
                        <h2>Start applying for a job that you are interested in!</h2>
                        <a href="{{ route('jobs.search.index') }}" class="btn btn-primary btn-lg">Apply here</a>
                    </div>
                @endif
            </div>
        @else
            <div class="d-flex flex-column justify-content-center align-items-center">
                {{ $applicantProfile }}
                <h2>Looks like you haven't set your profile.</h2>
                <a href="{{ route('applicant.profile') }}" class="btn btn-primary btn-lg">Update personal profile</a>
            </div>
        @endif
    </div>
</div>
