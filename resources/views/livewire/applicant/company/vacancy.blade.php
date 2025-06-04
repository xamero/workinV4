<div>
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-2 mb-3">
        @foreach ($vacancies as $vacancy)
        <div class="col">
            <div class="card h-100">
                <a href="{{ route('jobs.search.index', ['search' => $vacancy->title, 'vacancyId' => $vacancy->id]) }}">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <small class="flex-nowrap text-muted me-1"><i class="far fa-clock"></i>
                                {{$vacancy->created_at->diffForHumans()}}
                            </small>
                            <small class="flex-nowrap text-muted me-1"><i class="fas fa-briefcase"></i>
                                {{$vacancy->job_type}}</small>
                            @if($vacancy->subSpecialization)
                            <small class="flex-nowrap text-muted me-1"><i class="fas fa-hashtag"></i>
                                {{$vacancy->subSpecialization->name}}
                            </small>
                            @endif
                        </div>
                        <h4 class="card-title">{{ $vacancy->title }}</h4>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>


    @if ($vacancies->count() == 0)
    <div class="d-flex justify-content-center align-items-center position-static">
        <p class="text-muted text-center">The firm has not advertised any employment openings.</p>
    </div>
    @endif
    @if ($vacancies->count() === $perPage && $vacancies->count() != 0)
    <div class="d-flex justify-content-center">
        <button type="button" name="load-more" id="load-more" class="btn btn-outline-secondary" wire:click="loadMore">
            Load more
        </button>
    </div>
    @endif
</div>
