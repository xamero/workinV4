<div class="">
    <div class="row my-5">
        <div class="col-md-4">
            @if ($results != null)
                <div class="row row-cols-1 g-4">
                    @foreach ($results as $result)
                        <div class="col" title="More details"
                            wire:click="getVacancyDetails({{ $result->id }})" style="cursor:pointer">
                            <div class="card bg-white z-n1">
                                <div wire:loading wire:target="getVacancyDetails({{ $result->id }})"
                                    class="loading-bar rounded-3"></div>
                                @if ($vacancyId == $result->id)
                                    <div class="rounded-3 static-bar" wire:loading.remove
                                        wire:target="getVacancyDetails({{ $result->id }})"></div>
                                @endif
                                <div class="card-header rounded border-bottom-0 bg-white pt-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center "
                                        style="width:6rem; height:6rem; max-width: 6rem">
                                        @if ($result->company != null)
                                            @if ($result->company->logo != null)
                                                <img src="{{ asset('storage/company/' . $result->company->logo) }}"
                                                    class="mb-3 img-fluid " alt=""
                                                    style="max-width: 5rem">
                                            @endif
                                        @endif
                                    </div>

                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ strtoupper($result->title) }}</h4>
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
                                    <p class="text-muted">{{ $result->company->name }} |
                                        {{ $result->location }}</p>
                                    {{-- <p class="text-muted">Listed {{
                                Carbon\Carbon::parse($result->created_at)->diffForHumans() }}
                            </p> --}}
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
                            <button type="button" name="load-more" id="load-more" class="btn"
                                wire:click="loadMore" wire:key="loadMore">
                                <span wire:loading wire:target="loadMore">
                                    <div class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </span>
                                <span wire:loading.remove wire:target="loadMore">Load more</span>
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>

      
            <div class="col-md-8 ">
                <div class="sticky">
                    @if($vacancy)
                    <livewire:applicant.jobs.application.apply :id="$vacancyId" :key="$vacancyId"
                        wire:key="{{ $vacancy->id }}" />
                     @elseif ($results->count() > 0 && !empty($search))
                    <div class="d-flex justify-content-center align-items-center flex-column vh-100">
                        <i class="fa-solid fa-hand-pointer fa-10x"></i>
                        <p class="fs-2 text-center">Choose the career opportunity that interests you!</p>
                    </div>
                    @endif
                </div>
            </div>
  
    </div>
</div>