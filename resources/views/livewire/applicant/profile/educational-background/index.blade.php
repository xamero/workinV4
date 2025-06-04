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
                        <h4><i class="fas fa-graduation-cap"></i> Educational Background</h4>
                        @if($educations != null)
                        <div class="row mb-3 g-3">
                            @forelse($educations as $key=>$educ)
                            <div class="col-md-10">
                                <div class="row g-2">
                                    <div class="col">
                                        <div class="mb-0" id="educ-level-{{ $key }}">
                                            @if($educ->level == 1)
                                            Elementary
                                            @elseif($educ->level == 2)
                                            High School
                                            @elseif($educ->level == 3)
                                            Technical Vocational
                                            @elseif($educ->level == 4)
                                            College
                                            @elseif($educ->level == 5)
                                            Post-Graduate
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-0" id="educ-school-{{ $key }}">{{$educ->school}}</div>
                                        <div class="mb-0" id="educ-course-{{ $key }}">{{$educ->course}}</div>
                                        <div class="mb-0" id="educ-highlights-{{ $key }}">{{$educ->highlights}}</div>
                                        <div class="mb-0 text-muted" id="educ-year_graduated-{{ $key }}">
                                            {{$educ->year_graduated}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2 d-flex justify-content-lg-end">
                                <button class="btn btn-sm btn-lite-primary mb-1 me-1"
                                        wire:click="editEducationalBackground('{{$educ->id}}')"
                                        wire:key="{{'educ' . $educ->id}}">
                                            <span wire:loading wire:target="editEducationalBackground('{{$educ->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                    <span wire:loading.remove wire:target="editEducationalBackground('{{$educ->id}}')"><x-awesome.edit class="edit"></x-awesome.edit></span>
                                </button>
                                <button class="btn btn-sm btn-lite-danger mb-1 me-1"
                                        wire:click="confirmDeleteEducationalBackground('{{$educ->id}}')"
                                        wire:key="{{'educ' . $educ->id}}">
                                             <span wire:loading wire:target="confirmDeleteEducationalBackground('{{$educ->id}}')">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            </span>
                                    <span wire:loading.remove wire:target="confirmDeleteEducationalBackground('{{$educ->id}}')">
                                                <x-awesome.trash></x-awesome.trash>
                                            </span>
                                </button>




{{--                                <button class="btn btn-sm btn-lite-primary mb-1 me-1" id="edit-educ-{{ $key }}"--}}
{{--                                    wire:click="editEducationalBackground('{{$educ->id}}')"><x-awesome.edit></x-awesome.edit></button>--}}
{{--                                <button class="btn btn-sm btn-lite-danger mb-1 me-1"--}}
{{--                                    wire:click="deleteEducationalBackground('{{$educ->id}}')"--}}
{{--                                    id="delete-educ-{{ $key }}"--}}
{{--                                    wire:confirm="Are you sure you want to delete this record?"><x-awesome.trash></x-awesome.trash></button>--}}
                            </div>
                            @empty
                            <div class="col d-flex justify-content-center">
                                <p>No record</p>
                            </div>
                            @endforelse
                        </div>
                        @endif
                        <button class="btn btn-sm btn-lite-secondary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasEducationalBackground" wire:click="addEducationalBackground">
                            <x-awesome.add></x-awesome.add>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.applicant.profile.educational-background.offcanvas-educational-background')
</div>
