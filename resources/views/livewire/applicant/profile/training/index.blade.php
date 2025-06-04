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
                        <h4><i class="fas fa-cogs"></i> Trainings</h4>
                        @if($trainings != null)
                        <div class="row g-2 mb-3">
                            @forelse($trainings as $training)
                            <div class="col-md-10">
                                <div class="mb-0">{{ $training->name }}</div>
                                <div class="mb-0 text-muted">
                                    @if($training->date_start)
                                    {{ $training->date_start->format('F d, Y') }}
                                    @endif
                                    @if($training->date_end)
                                    - {{ $training->date_end->format('F d, Y') }}
                                    @endif
                                </div>
                                <div class="mb-0 text-muted">{{ $training->institution }}</div>
                                <div class="mb-0 text-muted">{{ $training->certificate }}</div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-lg-end">
                                <button class="btn btn-sm btn-lite-primary mb-1 me-1"
                                        wire:click="editTraining('{{$training->id}}')"
                                        wire:key="{{'training-edit' . $training->id}}">
                                            <span wire:loading wire:target="editTraining('{{$training->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                    <span wire:loading.remove wire:target="editTraining('{{$training->id}}')"><x-awesome.edit class="edit"></x-awesome.edit></span>
                                </button>
                                <button class="btn btn-sm btn-lite-danger mb-1 me-1"
                                        wire:click="confirmDeleteTraining('{{$training->id}}')"
                                        wire:key="{{'training-delete' . $training->id}}">
                                             <span wire:loading wire:target="confirmDeleteTraining('{{$training->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                    <span wire:loading.remove wire:target="confirmDeleteTraining('{{$training->id}}')">
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
                        <button class="btn btn-sm btn-lite-secondary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasTraining" wire:click="addTraining">
                            <x-awesome.add></x-awesome.add>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.applicant.profile.training.offcanvas-training')
</div>
