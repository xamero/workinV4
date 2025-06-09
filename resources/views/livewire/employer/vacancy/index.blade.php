<div class="container-fluid">
        <div class="row">
            <div class="col-md-12 table-responsive border bg-white rounded p-3 shadow-lg">
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
                <livewire:views.vacancies.vacancies-by-company-table :company_id="$company->id" :status="$status" />
                @include('livewire.employer.vacancy.offcanvas-edit')
            </div>
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

                    setup: function(editor) {
                        editor.on('init change', function() {
                            editor.save();
                        });
                        editor.on('change', function(e) {
                            @this.set('details', editor.getContent());
                        });
                    },

                });
            });
        </script>
    @endscript
</div>
