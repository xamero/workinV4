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
                        <h4><i class="fas fa-bookmark"></i> Licenses and Eligibilities</h4>
                        @if($licenses != null)
                        <div class="row g-2 mb-3">
                            @forelse($licenses as $license)
                            <div class="col-md-10">
                                <div class="mb-0">{{$license->name}}</div>
                                <div class="mb-0 ">{{$license->issuer}}</div>
                                <div class="mb-0 text-muted">
                                    @if($license->date_of_issuance)
                                        {{ $license->date_of_issuance->format('F d, Y') }}
                                    @endif

                                    @if($license->date_of_expiration)
                                        - {{ \Carbon\Carbon::parse($license->date_of_expiration)->format('F d, Y')}}
                                    @endif
                                </div>
                                <div class="text-muted">{{$license->description}}</div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-lg-end">
                                <button class="btn btn-sm btn-lite-primary mb-1 me-1"
                                        wire:click="editLicense('{{$license->id}}')"
                                        wire:key="{{'license' . $license->id}}">
                                            <span wire:loading wire:target="editLicense('{{$license->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                    <span wire:loading.remove wire:target="editLicense('{{$license->id}}')"><x-awesome.edit class="edit"></x-awesome.edit></span>
                                </button>
                                <button class="btn btn-sm btn-lite-danger mb-1 me-1"
                                        wire:click="confirmDeleteLicense('{{$license->id}}')"
                                        wire:key="{{'license' . $license->id}}">
                                             <span wire:loading wire:target="confirmDeleteLicense('{{$license->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                    <span wire:loading.remove wire:target="confirmDeleteLicense('{{$license->id}}')">
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
                            data-bs-target="#offcanvasLicensesEligibilities" wire:click="addLicense">
                            <x-awesome.add></x-awesome.add>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.applicant.profile.license-eligibilities.offcanvas-license-eligibility')
</div>
