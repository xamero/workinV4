<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1"
     id="offcanvasVacancy">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Job Vacancy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form wire:submit="{{$action}}">
            <div class="row mb-3">
                <x-form-panel-vertical>
                    <x-label class="required">Job Title</x-label>
                    <x-input type="text" wire:model="title"
                             class="{{$errors->has('title') ? 'is-invalid':''}}"></x-input>
                    @error('title')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical>
                    <x-label class="required">Place of Assignment</x-label>
                    <x-input type="text" wire:model="location"
                             class="{{$errors->has('location') ? 'is-invalid':''}}"></x-input>
                    @error('location')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col">
                    <x-label class="required">Category (Specialization)</x-label>
                    <select class="form-control {{$errors->has('sub_specialization_id') ? 'is-invalid':''}}"
                            wire:model="sub_specialization_id">
                        <option selected></option>
                        @foreach($subspecializations as $sub)
                            <option value="{{$sub->id}}">{{$sub->name}}</option>
                        @endforeach
                    </select>
                    @error('sub_specialization_id')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <label for="">Salary Range</label>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">From</x-label>
                    <x-input type="number" wire:model="salary_from"
                             class="{{$errors->has('salary_from') ? 'is-invalid':''}}"></x-input>
                    @error('salary_from')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label>To</x-label>
                    <x-input type="number" wire:model="salary_to"
                             class="{{$errors->has('salary_to') ? 'is-invalid':''}}"></x-input>
                    @error('salary_to')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3">
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Total Vacancies</x-label>
                    <x-input type="number" wire:model="total_vacancy"
                             class="{{$errors->has('total_vacancy') ? 'is-invalid':''}}"></x-input>
                    @error('total_vacancy')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
                <x-form-panel-vertical class="col-md-6">
                    <x-label class="required">Job Type</x-label>
                    <select wire:model="job_type" class="form-control {{$errors->has('job_type') ? 'is-invalid':''}}">
                        <option value="" selected></option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                    @error('job_type')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </x-form-panel-vertical>
            </div>
            <div class="row mb-3" wire:ignore>
                <div class="col">
                    <x-label class="required">Details</x-label>
                    <textarea  wire:model="details" id="detalye" cols="30" rows="10"
                              class="form-control {{$errors->has('details') ? 'is-invalid':''}}"></textarea>
                    @error('details')
                    <x-slot name="message">{{$message}}</x-slot>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <x-button class="btn-secondary">
                <span wire:loading wire:target="{{$action}}">
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Saving...
                </span>
                        <span wire:loading.remove wire:target="{{$action}}">
                Save</span></x-button>
                </div>
            </div>
        </form>
    </div>

    @script
    <script type="module">
        Livewire.on('show-tinyMce', () => {
            tinymce.remove('textarea#detalye');
            tinymce.init({
                selector: 'textarea#detalye',
                plugins: [
                    'advlist', 'lists', 'link',
                    'code', 'table'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',

                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                    editor.on('change', function (e) {
                        $wire.set('details', editor.getContent());
                    });
                },

            });
        });

        Livewire.on('getLetter', () => {
            var letterContent = tinymce.activeEditor.getContent("letter");

            $wire.dispatch('saveApplication', [letterContent]);
        });

    </script>
    @endscript
</div>

