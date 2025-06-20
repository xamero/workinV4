<div wire:ignore.self class="offcanvas w-100 offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasApply">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 ">Create and send application</h5>
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
        <div class="card mb-3">
            <div class="card-body">
                <p>Job title: {{$activeVacancy->title}}</p>
                <p>Company: {{$activeVacancy->company->name}}</p>

            </div>
        </div>
        <div class="row mb-3" wire:ignore>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                <div class="form-group">
                    <label for="letter" class="required">Cover letter</label>
                    <textarea name="letter" id="letter" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <p>By saving your information, you agree to our <a href="">Privacy Policy</a>.</p>
            </div>
        </div>

        <x-button class="btn-secondary" wire:click="$dispatch('getLetter')">
            <span wire:loading >
                <div class="spinner-grow spinner-grow-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                Processing...
            </span>
            <span wire:loading.remove >
                Send my application</span>
        </x-button>

    </div>

    @script
    <script type="module">
        Livewire.on('show-tinyMce', () => {
            tinymce.remove('textarea#letter');
            tinymce.init({
                selector: 'textarea#letter',
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
                        $wire.set('letters', editor.getContent());
                    });
                },

            });
        });

        Livewire.on('getLetter', () => {
            var letterContent = tinymce.activeEditor.getContent("#letter");
            $wire.dispatch('saveApplication', [letterContent]);
        });

    </script>
    @endscript
</div>
