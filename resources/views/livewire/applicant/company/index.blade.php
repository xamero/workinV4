<div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6 position-relative">
                    <div class="d-none d-md-block position-absolute w-100 top-50 start-0 translate-middle-y">
                        <h1 class="text-secondary">Your dream workplace is here!</h1>
                        <p>Search and scroll through the list of our partner companies.</p>
                        <div class="progress mb-0" wire:loading style="">
                            <div class="loader"></div>
                        </div>
                        {{-- <div class="progress" wire:loadin>--}}
                            {{-- <div class="loader">dff</div>--}}
                            {{-- </div>--}}
                        <input type="text" class="form-control form-control-lg " wire:model.live="search" />
                    </div>
                    <div class="py-5 d-md-none"
                        style="background: url('{{asset('lam-ang/images/company/buildings.png')}}'); background-size: cover">
                        <h1 class="text-secondary">Your dream workplace is here!</h1>
                        <p>Search and scroll through the list of our partner companies.</p>
                        <div class="progress mb-0" wire:loading style="">
                            <div class="loader"></div>
                        </div>
                        <input type="text" class="form-control form-control-lg " wire:model.live="search" />
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('lam-ang/images/company/buildings.webp')}}"
                        class="d-none d-md-block img-fluid float-end" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4 d-none d-md-block">
                @if($results != null)
                <div class="row row-cols-1 g-4">
                    @foreach($results as $result)
                    <div class="col" wire:click="getCompanyDetails('{{$result->id}}')" style="cursor:pointer">
                        <div class="card bg-white">
                            <div wire:loading wire:target="getCompanyDetails('{{$result->id}}')"
                                class="loading-bar rounded-3"></div>
                            @if ($companyId == $result->id)
                                <div class="rounded-3 static-bar" wire:loading.remove
                                    wire:target="getCompanyDetails('{{$result->id}}')"></div>
                            @endif
                            <div class="card-header  border-bottom-0 bg-white rounded">
                                @if($result->logo != null)
                                <img src="{{asset('storage/company/'.  $result->logo)}}" class="mb-3 " alt=""
                                    style="max-width: 6rem">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$result->name}} sadsa</h5>
                                <p class="card-text">{{$result->address}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if ($results->count() === $perPage)
                    <div class="d-flex justify-content-center">
                        <button type="button" name="load-more" id="load-more" class="btn btn-outline-secondary"
                            wire:click="loadMore">
                            Load more
                        </button>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- mobile --}}
            <div class="col-12 d-md-none">
                @if($results != null && $company == null)
                <div class="row row-cols-1 g-4">
                    @foreach($results as $result)
                    <div class="col" wire:click="getCompanyDetails('{{$result->id}}')" style="cursor:pointer">
                        <div class="card bg-white">
                            <div class="card-header text-center border-bottom-0 bg-white">
                                @if($result->logo != null)
                                <img src="{{asset('storage/company/'.  $result->logo)}}" class="mb-3 " alt=""
                                    style="max-width: 6rem">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$result->name}}</h5>
                                <p class="card-text">{{$result->address}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if ($results->count() === $perPage)
                    <div class="d-flex justify-content-center">
                        <button type="button" name="load-more" id="load-more" class="btn btn-outline-secondary"
                            wire:click="loadMore">
                            Load more
                        </button>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            @if($company != null)
            <div class="col-md-8 ">
                <div class="sticky vh-100 card bg-white">
                    <div class="card-header bg-white border-bottom-0">
                        <div class="d-flex flex-row-reverse d-md-none">
                            <button type="button" class="btn btn-sm btn-outline-primary" wire:click="removeCompany">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="px-1">
                                    Back
                                </span>
                            </button>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <h2 class="display-5">{{$company->name ?? ''}}</h2>
                                <p class="text-muted">{{ $company->address }}</p>
                            </div>
                            <div class="col-md-3">
                                @if($company->logo != null)
                                <img src="{{asset('storage/company/'.  $company->logo)}}" class="mb-3 float-end " alt=""
                                    style="max-width: 8rem">
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card-body ">
                        <ul class="nav nav-tabs" id="company-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="" class="nav-link text-secondary active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview-tab-pane" role="tab" aria-controls="overview-tab-pane"
                                    aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="" class="nav-link text-secondary" id="job-tab" data-bs-toggle="tab"
                                    data-bs-target="#job-tab-pane" role="tab" aria-controls="job-tab-pane"
                                    aria-selected="false">Jobs</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="company-details">
                            <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="card border-0 bg-white my-3">
                                    <div class="card-body ">
                                        <p>{!! $company->company_overview !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="job-tab-pane" role="tabpanel" aria-labelledby="job-tab"
                                tabindex="0">
                                <div class="card border-0 bg-white">
                                    <div class="card-body">
                                        <livewire:applicant.company.vacancy :id="$company->id" :key="$company->id" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($results->count() == 0 && !empty($search))
            <div class="d-flex justify-content-center align-items-center flex-column text-center">
                <i class="fa-solid fa-magnifying-glass fa-9x d-none d-md-block"></i>
                <i class="fa-solid fa-magnifying-glass fa-5x d-md-none"></i>
                <p class="fs-2 mb-0">Sorry, no match was found with "{{ $search }}"!</p>
                <p class="fs-5 text-muted">Try other word or check for spelling errors.</p>
            </div>
            @endif
        </div>
    </div>
</div>