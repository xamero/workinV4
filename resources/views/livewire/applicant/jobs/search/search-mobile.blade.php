 {{-- mobile view --}}
 <div class="d-md-none">
    <div class="row my-5">
        <div class="col-md-4">
            @if ($results != null)
                <div class="row row-cols-1 g-4">
                    @if ($vacancy)
                        <livewire:applicant.jobs.application.apply :id="$vacancy->id" :key="$vacancy->id" />
                    @else
                        @foreach ($results as $result)
                            <div class="col" wire:click="getVacancyDetails({{ $result->id }})"
                                style="cursor:pointer">
                                <div class="card bg-white">
                                    <div class="card-header text-center border-bottom-0 bg-white">
                                        @if ($result->company != null)
                                            @if ($result->company->logo != null)
                                                <img src="{{ asset('storage/company/' . $result->company->logo) }}"
                                                    class="mb-3 " alt="" style="max-width: 6rem">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{ strtoupper($result->title) }}</h3>
                                        <div class="d-flex flex-wrap">
                                            <small class="flex-nowrap text-muted me-1"><i
                                                    class="far fa-clock"></i>
                                                {{ $result->created_at->diffForHumans() }}
                                            </small>
                                            <small class="flex-nowrap text-muted me-1"><i
                                                    class="fas fa-briefcase"></i>
                                                {{ $result->job_type }}</small>
                                            @if ($result->subSpecialization)
                                                <small class="flex-nowrap text-muted me-1"><i
                                                        class="fas fa-hashtag"></i>
                                                    {{ $result->subSpecialization->name }}
                                                </small>
                                            @endif
                                        </div>
                                        @if ($result->company != null)
                                        <p class="text-muted">{{ $result->company->name }} |
                                            {{ $result->location }}</p>
                                        @endif
                                        @if ($result->salary_from != null or $result->salary_to != null)
                                            <p class="text-muted">Salary:
                                                &#8369;{{ number_format($result->salary_from, 2) }}
                                                @if ($result->salary_to != null)
                                                    - &#8369;{{ number_format($result->salary_to, 2) }}
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($results->count() === $perPage)
                            <div class="d-flex justify-content-center">
                                <button type="button" name="load-more" id="load-more"
                                    class="btn btn-outline-secondary" wire:click="loadMore">
                                    Load more
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>