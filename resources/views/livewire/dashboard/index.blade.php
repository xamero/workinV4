<div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 col-lg-8">
                <h4 class="fw-bold">Welcome to your dashboard!</h4>
                <p> Welcome to workIN, your ultimate destination for all your career aspirations! We are thrilled to
                    have you join our dynamic job portal, where we connect talented individuals like you with exciting
                    employment opportunities.
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container py-5">
            <h4 class="mb-3 fw-bold">Recruitment Activities</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($activities as $event)
                    <div class="card bg-white  border-0">
                        <div class="card-header text-center  py-3 bg-primary text-white shadow">
                            @php
                                $daysUntil = \Carbon\Carbon::now()->diffInDays(
                                    \Carbon\Carbon::parse($event->start),
                                    false,
                                );
                                $daysUntil = ceil($daysUntil); // Round up to include partial days
                            @endphp

                            @if ($daysUntil > 0)
                                <p class="mb-0">{{ $daysUntil }} day{{ $daysUntil != 1 ? 's' : '' }} to go!</p>
                            @elseif ($daysUntil == 0)
                                <p class="mb-0">Event is today!</p>
                            @else
                                <p class="mb-0">Event has passed</p>
                            @endif
                        </div>
                        <div class="card-body text-center border-0  shadow">
                            <p class="fs-4 mb-0 fw-bold text-primary">{{ $event->type }}</p>
                            <p class="">{{ $event->venue ?? '' }}</p>

                            <p class="text-muted small"> {{ Str::limit($event->related_companies, 200) }}</p>

                            <a href="https://recruitment.workinilocosnorte.ph?session={{ $user_session->id }}"
                                target="_blank" class="btn btn-sm btn-primary">Register</a>

                        </div>
                        <div class="card-footer border-0 bg-primary text-white shadow">

                            <div class="row ">
                                <div class="col-6 text-center">
                                    <p class="mb-0 fs-6 text-uppercase">
                                        {{ \Carbon\Carbon::parse($event->start)->format("M d 'y") }}</p>
                                    <p class="small mb-0 ">
                                        {{ \Carbon\Carbon::parse($event->start)->format('h:i A') }}</p>
                                </div>
                                <div class="col-6 text-center border-start">
                                    @if ($event->end)
                                        <p class=" mb-0 fs-6 text-uppercase">
                                            {{ \Carbon\Carbon::parse($event->end)->format("M d 'y") }}</p>
                                        <p class=" small mb-0">
                                            {{ \Carbon\Carbon::parse($event->end)->format('h:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid bg-muted">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pt-5">
                    <h4 class="fw-bold mb-5">Trainings and More</h4>
                    {{-- <p class="">Be prepared and equipped, join and enroll in our training programs.</p> --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="card h-100">
                                <img src="{{ asset('lam-ang/images/dashboard/jobstart.jpg') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Job Start Philippines Program</h5>
                                    <a href="">Read more...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row h-100">
                                <div class="col-12 mb-2">
                                    <div class="card h-100">
                                        <div class="card-body text-center d-flex align-items-center justify-content-center">
                                            <p class="fs-4 mb-0 fw-bold text-primary"> Work Readiness Program</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-body text-center d-flex align-items-center justify-content-center">
                                             <p class="fs-4 mb-0 fw-bold text-primary">Government Internship Program</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-5">
                    <h4 class="fw-bold">Our Partner Companies</h4>
                    <div id="companyCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($companies->chunk(25) as $index => $chunk)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="d-flex flex-wrap justify-content-center align-items-center p-4">
                                        @foreach ($chunk as $company)
                                            @if ($company->logo)
                                                <img src="{{ asset('storage/company/' . $company->logo) }}"
                                                    alt="{{ $company->name }}" class="img-fluid m-2"
                                                    style="max-height: 60px; max-width: 120px;">
                                            @else
                                                <span class="m-1 badge text-bg-secondary">{{ $company->name }}</span>
                                                {{-- <div class="d-flex align-items-center justify-content-center m-2 border rounded p-2"
                                                    style="min-height: 30px; min-width: 120px; ">
                                                    <span
                                                        class="text-muted small text-center">{{ $company->name }}</span>
                                                </div> --}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#companyCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#companyCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                        <!-- Carousel Indicators -->
                        <div class="carousel-indicators">
                            @foreach ($companies->chunk(20) as $index => $chunk)
                                <button type="button" data-bs-target="#companyCarousel"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Optional: Add custom styling for better carousel controls visibility -->
                    <style>
                        .carousel-control-prev-icon,
                        .carousel-control-next-icon {
                            background-color: rgba(0, 0, 0, 0.5);
                            border-radius: 50%;
                            padding: 20px;
                        }

                        .carousel-item {
                            min-height: 200px;
                        }
                    </style>
                </div>

            </div>
        </div>
    </div>
