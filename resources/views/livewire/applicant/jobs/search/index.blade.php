<div>

    <div class="container-fluid position-relative"
        style=" background-image: url('{{ asset('image/hero.webp') }}'); background-size: cover; background-position: center; height: 100%;">
        {{-- <div class="bg-pilipinas position-absolute top-0 start-0 w-100 h-100" style="z-index:-1;"></div> --}}
        <div class="container position-relative">
            <div class="row" style="min-height: 35rem;">
                <div class="col-md-6 position-relative">
                    <div class="d-none d-md-block position-absolute w-100 top-50 start-0 translate-middle-y">
                        <h1 class="text-white">Your dream job is waiting!</h1>
                        <p class="text-white">Just give us some hint of what you are looking for.</p>
                        <div class="progress mb-0" wire:loading style="">
                            <div class="loader"></div>

                        </div>
                        <div class="row row-cols-md-1 row-cols-lg-2 g-2 mb-3">
                            <div class="col-md-12 col-lg-8">
                                <input type="text" class="form-control form-control-lg rounded-4"
                                    wire:model.live="search">
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="dropdown open">
                                    <button class="form-control form-control-lg rounded-4 dropdown-toggle"
                                        type="button" id="specialization-filter" data-bs-toggle="dropdown"
                                        aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
                                        {{ $specialization ? count($specialization) . ' Specialization' : 'Specialization' }}
                                    </button>
                                    <div class="dropdown-menu p-0" aria-labelledby="specialization-filter">
                                        <div class="accordion accordion--custom border-0" id="specialization">
                                            @foreach ($specializations as $spec)
                                                <div class="accordion-item text-black bg-white"
                                                    id="accordion-{{ $spec->id }}">
                                                    <p class="accordion-header"
                                                        id="specialization-name-{{ $spec->id }}">
                                                        <button class="accordion-button text-black" type="button"
                                                            id="accordion-button-{{ $spec->id }}"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-specialization-{{ $spec->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse-specialization-{{ $spec->id }}">
                                                            {{ $spec->name }}
                                                        </button>
                                                    </p>
                                                    <div id="collapse-specialization-{{ $spec->id }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="specialization-name">
                                                        <div class="accordion-body">
                                                            @foreach ($spec->SubSpecialization as $subSpec)
                                                                <div class="form-group form-check">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="{{ $subSpec->id }}"
                                                                            id="sub-specialization-{{ $subSpec->id }}"
                                                                            wire:model="specialization" />
                                                                        {{ $subSpec->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Filter large view --}}
                        <div class="d-flex">
                            <div class="mb-3 me-2">
                                <div class="dropdown">
                                    <button class="btn text-white dropdown-toggle" type="button" id="triggerId"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        data-bs-auto-close="outside">
                                        {{ $type ? $type : 'All types of job' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="All types of job"
                                                id="all-type" wire:model.live="type" />
                                            <label class="form-check-label" for="all-type"> All types of job </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="Full time"
                                                id="fulltime" wire:model.live="type" />
                                            <label class="form-check-label" for="fulltime"> Full time </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="Part-Time"
                                                id="part-time" wire:model.live="type" />
                                            <label class="form-check-label" for="part-time"> Part time </label>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 me-2">
                                <div class="dropdown">
                                    <button class="btn text-white  dropdown-toggle" type="button" id="salary-range-to"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Paying <span>&#8369;</span>{{ $salaryRange ? $salaryRange : '0' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="salary-range-to">
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="0"
                                                id="salary-range-from-0" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-0">
                                                <span>&#8369;</span>0
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="10000"
                                                id="salary-range-from-10k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-10k">
                                                <span>&#8369;</span>10K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="15000"
                                                id="salary-range-from-15k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-15k">
                                                <span>&#8369;</span>15K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="20000"
                                                id="salary-range-from-20k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-20k">
                                                <span>&#8369;</span>20K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="30000"
                                                id="salary-range-from-30k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-30k">
                                                <span>&#8369;</span>30K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="40000"
                                                id="salary-range-from-40k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-40k">
                                                <span>&#8369;</span>40K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="50000"
                                                id="salary-range-from-50k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-50k">
                                                <span>&#8369;</span>50K
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 me-2">
                                <div class="dropdown ">
                                    <button class="btn  text-white  dropdown-toggle" type="button"
                                        id="salary-range-to" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        To <span>&#8369;</span>{{ $salaryRangeTo ? $salaryRangeTo : '0' }}
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="salary-range-to">
                                        <button type="button" class="dropdown-item  text-muted ">
                                            <input class="form-check-input" type="radio" value="0"
                                                id="salary-range-to-0" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 0 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-0">
                                                <span>&#8369;</span>0
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="10000"
                                                id="salary-range-to-10k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 10000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-10k">
                                                <span>&#8369;</span>10K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="15000"
                                                id="salary-range-to-15k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 15000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-15k">
                                                <span>&#8369;</span>15K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="20000"
                                                id="salary-range-to-20k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 20000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-20k">
                                                <span>&#8369;</span>20K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="30000"
                                                id="salary-range-to-30k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 30000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-30k">
                                                <span>&#8369;</span>30K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="40000"
                                                id="salary-range-to-40k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 40000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-40k">
                                                <span>&#8369;</span>40K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="50000"
                                                id="salary-range-to-50k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 50000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-50k">
                                                <span>&#8369;</span>50K
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 me-2">
                                <div class="dropdown ">
                                    <button class="btn text-white  dropdown-toggle" type="button" id="listed"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Listed {{ $listed ? $listed : 'Any time' }}
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="listed">
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" value="Any time" type="radio"
                                                id="listed-any-time" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-any-time">
                                                Any time
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="Today"
                                                id="listed-today" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-today">
                                                Today
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="last 3 days"
                                                id="listed-3-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-3-days">
                                                Last 3 days
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="last 7 days"
                                                id="listed-7-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-7-days">
                                                Last 7 days
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="last 14 days"
                                                id="listed-14-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-14-days">
                                                Last 14 days
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted ">
                                            <input class="form-check-input" type="radio" value="last 30 days"
                                                id="listed-30-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-30-days">
                                                Last 30 days
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- mobile view --}}
                    <div class="py-5 d-md-none" style="">
                        <h1 class="text-white">Your dream job is waiting!</h1>
                        <p class="text-white">Just give us some hint fo what you are looking for.</p>
                        <div class="progress mb-0" wire:loading style="">
                            <div class="loader"></div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg rounded-4"
                                wire:model.live="search">
                        </div>
                        <div class="mb-3">
                            <div class="dropdown-center open">
                                <button class="form-control form-control-lg rounded-4 dropdown-toggle" type="button"
                                    id="specialization-filter" data-bs-toggle="dropdown" aria-haspopup="true"
                                    data-bs-auto-close="outside" aria-expanded="false">
                                    {{ $specialization ? count($specialization) . ' Specialization' : 'Specialization' }}
                                </button>
                                <div class="dropdown-menu p-0" aria-labelledby="specialization-filter" style="z-index: 1000;">
                                    <div class="accordion accordion--custom border-0" id="specialization">
                                        @foreach ($specializations as $spec)
                                            <div class="accordion-item text-black bg-white"
                                                id="accordion-{{ $spec->id }}">
                                                <p class="accordion-header"
                                                    id="specialization-name-{{ $spec->id }}">
                                                    <button class="accordion-button text-black" type="button"
                                                        id="accordion-button-{{ $spec->id }}"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-specialization-{{ $spec->id }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapse-specialization-{{ $spec->id }}">
                                                        {{ $spec->name }}
                                                    </button>
                                                </p>
                                                <div id="collapse-specialization-{{ $spec->id }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="specialization-name">
                                                    <div class="accordion-body">
                                                        @foreach ($spec->SubSpecialization as $subSpec)
                                                            <div class="form-group form-check">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $subSpec->id }}"
                                                                        id="sub-specialization-{{ $subSpec->id }}"
                                                                        wire:model="specialization" />
                                                                    {{ $subSpec->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex overflow-x-scroll overflow-y-visible">

                            <nav class="nav flex-column">
                                <div class="dropdown position-static">
                                    <button class="btn text-white dropdown-toggle" type="button" id="triggerId"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        data-bs-auto-close="outside">
                                        {{ $type ? $type : 'All types of job' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="All types of job"
                                                id="all-type" wire:model.live="type" />
                                            <label class="form-check-label" for="all-type"> All types of job </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="Full time"
                                                id="fulltime" wire:model.live="type" />
                                            <label class="form-check-label" for="fulltime"> Full time </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="Part time"
                                                id="part-time" wire:model.live="type" />
                                            <label class="form-check-label" for="part-time"> Part time </label>
                                        </button>
                                    </div>
                                </div>
                                <div class="dropdown position-static">
                                    <button class="btn  text-white dropdown-toggle" type="button"
                                        id="salary-range-to" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Paying <span>&#8369;</span>{{ $salaryRange ? $salaryRange : '0' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="salary-range-to">
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="0"
                                                id="salary-range-from-0" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-0">
                                                <span>&#8369;</span>0
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="10000"
                                                id="salary-range-from-10k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-10k">
                                                <span>&#8369;</span>10K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="15000"
                                                id="salary-range-from-15k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-15k">
                                                <span>&#8369;</span>15K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="20000"
                                                id="salary-range-from-20k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-20k">
                                                <span>&#8369;</span>20K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="30000"
                                                id="salary-range-from-30k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-30k">
                                                <span>&#8369;</span>30K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="40000"
                                                id="salary-range-from-40k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-40k">
                                                <span>&#8369;</span>40K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="50000"
                                                id="salary-range-from-50k" wire:model.live="salaryRange" />
                                            <label class="form-check-label" for="salary-range-from-50k">
                                                <span>&#8369;</span>50K
                                            </label>
                                        </button>
                                    </div>
                                </div>
                                <div class="dropdown position-static">
                                    <button class="btn  text-white dropdown-toggle" type="button"
                                        id="salary-range-to" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        To <span>&#8369;</span>{{ $salaryRangeTo ? $salaryRangeTo : '0' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="salary-range-to">
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="0"
                                                id="salary-range-to-0" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 0 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-0">
                                                <span>&#8369;</span>0
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="10000"
                                                id="salary-range-to-10k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 10000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-10k">
                                                <span>&#8369;</span>10K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="15000"
                                                id="salary-range-to-15k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 15000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-15k">
                                                <span>&#8369;</span>15K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="20000"
                                                id="salary-range-to-20k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 20000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-20k">
                                                <span>&#8369;</span>20K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="30000"
                                                id="salary-range-to-30k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 30000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-30k">
                                                <span>&#8369;</span>30K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="40000"
                                                id="salary-range-to-40k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 40000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-40k">
                                                <span>&#8369;</span>40K
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="50000"
                                                id="salary-range-to-50k" wire:model.live="salaryRangeTo"
                                                {{ $salaryRange > 50000 ? 'Disabled' : '' }} />
                                            <label class="form-check-label" for="salary-range-to-50k">
                                                <span>&#8369;</span>50K
                                            </label>
                                        </button>
                                    </div>
                                </div>
                                <div class="dropdown position-static">
                                    <button class="btn  text-white dropdown-toggle" type="button" id="listed"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Listed {{ $listed ? $listed : 'Any time' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="listed">
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" value="Any time" type="radio"
                                                id="listed-any-time" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-any-time">
                                                Any time
                                            </label>
                                        </button>

                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="Today"
                                                id="listed-today" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-today">
                                                Today
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="last 3 days"
                                                id="listed-3-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-3-days">
                                                Last 3 days
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="last 7 days"
                                                id="listed-7-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-7-days">
                                                Last 7 days
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="last 14 days"
                                                id="listed-14-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-14-days">
                                                Last 14 days
                                            </label>
                                        </button>
                                        <button type="button" class="dropdown-item text-muted">
                                            <input class="form-check-input" type="radio" value="last 30 days"
                                                id="listed-30-days" wire:model.live="listed" />
                                            <label class="form-check-label" for="listed-30-days">
                                                Last 30 days
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {{-- <img src="{{asset('lam-ang/images/jobs/job.webp')}}" class="d-none d-md-block img-fluid float-end"
                        alt=""> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        @if ($isMobile)
            @include('livewire.applicant.jobs.search.search-mobile')
        @else
            @include('livewire.applicant.jobs.search.search-desktop')
        @endif

        @if ($results->count() == 0 && !empty($search))
            <div class="d-flex justify-content-center align-items-center flex-column text-center">
                <i class="fa-solid fa-magnifying-glass fa-9x d-none d-md-block"></i>
                <i class="fa-solid fa-magnifying-glass fa-5x d-md-none"></i>
                <p class="fs-2 mb-0">Sorry, no match was found with "{{ $search }}"!</p>
                <p class="fs-5 text-muted">Try adjusting the filters or check for spelling errors.</p>
            </div>
        @endif
    </div>

</div>
