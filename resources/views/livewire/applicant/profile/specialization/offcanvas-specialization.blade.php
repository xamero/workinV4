<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
    id="offcanvasSpecialization">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Specialization</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">

        <form wire:submit="saveSpecialization">
            <div class="mb-3">
                <div class="accordion">
                    @foreach ($Specializations as $Specialization)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed border-bottom" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse-{{ $Specialization->id }}"
                                aria-expanded="true" aria-controls="collapseOne">
                                {{ $Specialization->name }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $Specialization->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($Specialization->SubSpecialization as $SubSpecialization)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $SubSpecialization->id }}"
                                        id="SubSpecialization-{{ $SubSpecialization->id }}"
                                        wire:model="SubSpecialization" />
                                    <label class="form-check-label"
                                        for="SubSpecialization-{{ $SubSpecialization->id }}">
                                        {{ $SubSpecialization->name }} </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <p>By saving your information, you agree to our <a href="">Privacy Policy</a>.</p>
                </div>
            </div>
            <x-button class="btn-secondary" type="submit">
                <span wire:loading wire:target="saveSpecialization">
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Processing...
                </span>
                <span wire:loading.remove wire:target="saveSpecialization">
                    Save specialization</span>
            </x-button>
        </form>
    </div>
</div>
