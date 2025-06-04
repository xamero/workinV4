<div>
    @if($activeApplication != null)
        <div wire:loading>
            <div class="d-flex justify-content-center text-primary">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-header bg-white border-bottom-0">
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
                <div class="d-flex flex-row-reverse d-md-none">
                    <button type="button" class="btn btn-sm btn-outline-primary"
                            wire:click="$dispatch('removeVacancy')">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="px-1">
                        Back
                    </span>
                    </button>
                </div>
                <div class="row mt-3">
                    <div class="col-md-9">
                        <h2 class="display-5">{{$activeApplication->company->name ?? ''}}</h2>
                    </div>
                    <div class="col-md-3">
                        @if($activeApplication->company != null)
                            @if($activeApplication->company->logo != null)
                                <img src="{{asset('storage/company/'.  $activeApplication->company->logo)}}"
                                     class="mb-3 float-end "
                                     alt="" style="max-width: 8rem">
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="card bg-white border-0 p-3">
                    <div class="card-body ">
                        @if($activeApplication)
                            <div class="alert alert-info">
                                @foreach ($activeApplication->applicantProfile as $applied)
                                    @if($applied->status == 1)
                                        <span class="badge bg-success">✓</span>
                                        {{$activeApplication->company->name ?? ''}} has responded to your job
                                        application. Please check
                                        your
                                        registered email.
                                    @elseif($applied->status == 2)
                                        <div class="badge bg-danger">X</div>
                                        {{$activeApplication->company->name ?? ''}} has declined your job application.
                                    @else
                                        <div class="badge bg-warning">O</div>
                                        {{$activeApplication->company->name ?? ''}} has not responded to your job
                                        application.
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <x-button class="btn-lite-primary float-end"
                                  wire:click="withdrawApplication({{ $activeApplication->id }})"
                                  wire:confirm="Are you sure you want to withdraw this application?">Withdraw
                            application
                        </x-button>
                        <p class="lead">{{$activeApplication->title}}</p>
                        <p>Location: {{$activeApplication->location}}</p>
                        <p>Salary Range: {{$activeApplication->salary_from ?? 'Not specified'}}
                            to {{$activeApplication->salary_to ?? 'Not specified'}}</p>
                        <p>Type: {{$activeApplication->job_type}}</p>
                        <p>Total Vacancy: {{$activeApplication->total_vacancy ?? '1'}}</p>
                        <p>{!! $activeApplication->details !!}</p>
                    </div>
                </div>
                {{--            <div class="card border-0 bg-white my-3">--}}
                {{--                <div class="card-body ">--}}
                {{--                    --}}
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <p>Select one from your list on the left to view details.</p>
            </div>
        </div>
    @endif
</div>
