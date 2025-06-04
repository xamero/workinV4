<div>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
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
                <livewire:views.company.all-companies-table/>
                @include('livewire.peso.company.offcanvas-company' )
            </div>
        </div>
    </div>
</div>
@script
<script type="module">
    Livewire.on('show-tinyMce', () => {
        tinymce.remove('textarea#company_overview');
        tinymce.init({
            selector: 'textarea#company_overview',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                @this.set('company_overview', editor.getContent());
                });
            },

        });
    });

</script>
@endscript
