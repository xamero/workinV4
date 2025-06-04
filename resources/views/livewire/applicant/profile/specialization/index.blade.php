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
                        <h4><i class="fas fa-dot-circle"></i> Specialization</h4>
                        @if($Profile->SubSpecialization != null)
                        <div class="row g-1 mb-3">
                            @forelse($Profile->SubSpecialization as $SubSpecialize)
                            <div class="text-muted mb-0">{{ $SubSpecialize->name }}</div>
                            @empty
                            <div class="d-flex justify-content-center">
                                <p>No record</p>
                            </div>
                            @endforelse
                        </div>
                        @endif

                        <button class="btn btn-sm btn-lite-secondary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasSpecialization">
                            <x-awesome.edit></x-awesome.edit>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.applicant.profile.specialization.offcanvas-specialization')
</div>
