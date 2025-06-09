<div class="card bg-white border shadow-lg">
    <div class="card-body">
        <h3>Company Profile</h3>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($company != null)
            <button class="btn btn-secondary mb-5" type="button" wire:click="edit">
                Update company profile
            </button>
            <livewire:views.company.profile :company_id="$company->id" :key="time()" />
        @else
            <p>Connect your profile with your company profile!</p>
            <form wire:submit="connect">
                <div class="row mb-0">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Company code"
                                wire:model="company_code">
                            <button class="btn btn-primary" type="submit">
                                <span wire:loading wire:target="connectCompany">
                                    <div class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Connecting
                                </span>
                                <span wire:loading.remove wire:target="connectCompany">
                                    Connect</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <p class="small text-muted">Your company code can be found on your company profile. Ask your
                company's primary account manager for it.</p>
        @endif
    </div>
    @include('livewire.employer.company.offcanvas-companyprofile')
    {{-- @script
        <script type="module">
            Livewire.on('show-tinyMce', () => {
                tinymce.remove('textarea#company_overview');
                tinymce.init({
                    selector: 'textarea#company_overview',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
                    setup: function(editor) {
                        editor.on('init change', function() {
                            editor.save();
                        });
                        editor.on('change', function(e) {
                            @this.set('company_overview', editor.getContent());
                        });
                    },

                });
            });
        </script>
    @endscript --}}
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

                    setup: function(editor) {
                        editor.on('init change', function() {
                            editor.save();
                        });
                        editor.on('change', function(e) {
                            @this.set('company_overview', editor.getContent());
                        });
                    },

                });
            });
        </script>
    @endscript
</div>
