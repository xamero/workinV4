<div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 border rounded p-5">
                <h3>Job Vacancies</h3>
                @if($company != null)
                    @if($vacancies != null)
                        <div class="row row-cols-2 row-cols-md-5 g-4 mb-3">
                            @foreach($vacancies as $vacancy)
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$vacancy->title}}</h5>
                                            <p class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasVacancy">
                        Add Vacancy
                    </button>
                    <a href="" class="">See More</a>
                @endif
            </div>
        </div>
    </div>
    @include('livewire.employer.dashboard.offcanvas-vacancy')
</div>
