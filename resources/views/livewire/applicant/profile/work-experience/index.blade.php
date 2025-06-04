<div>
    <div class="container py-2 ">
        <div class="row ">
            <div class="col-md-10 col-lg-8 ">
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
                <div class="card bg-white ">
                    <div class="card-body">
                        <h4><i class="fas fa-briefcase"></i> Work Experiences</h4>
                        @if($works != null)
                            <div class="row g-3">
                                @forelse($works as $work)
                                    <div class="col-md-10">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <div class="mb-0">{{$work->position}}</div>
                                                <div class="mb-0 text-muted">{{$work->status}}</div>
                                                <div>{{$work->date_started->format('F d, Y')}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-0">{{$work->company}}</div>
                                                <div class="mb-0 text-muted">{{$work->address}}</div>
                                                <div class="mb-0 text-muted">{{$work->job_description}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-lg-end">
                                        <button class="btn btn-sm btn-lite-primary mb-1 me-1"
                                                wire:click="editWorkExperience('{{$work->id}}')"
                                                wire:key="{{'work' . $work->id}}">
                                            <span wire:loading wire:target="editWorkExperience('{{$work->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                            <span wire:loading.remove wire:target="editWorkExperience('{{$work->id}}')"><x-awesome.edit class="edit"></x-awesome.edit></span>
                                        </button>
                                        <button class="btn btn-sm btn-lite-danger mb-1 me-1"
                                                wire:click="confirmDeleteWorkExperience('{{$work->id}}')"
                                                wire:key="{{'work' . $work->id}}">
                                             <span wire:loading wire:target="confirmDeleteWorkExperience('{{$work->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                            <span wire:loading.remove wire:target="confirmDeleteWorkExperience('{{$work->id}}')">
                                                <x-awesome.trash></x-awesome.trash>
                                            </span>
                                        </button>
                                    </div>
                                @empty
                                    <div class="col d-flex justify-content-center">
                                        <p>No record</p>
                                    </div>
                                @endforelse
                            </div>
                        @endif
                        <button class="btn btn-sm btn-lite-secondary " type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasWorkExperience" wire:click="addWorkExperience">
                            <x-awesome.add class=""></x-awesome.add>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.applicant.profile.work-experience.offcanvas-work-experience')
</div>
