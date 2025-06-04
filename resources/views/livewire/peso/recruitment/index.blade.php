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
                <livewire:peso.recruitment.activity_table/>
                @include('livewire.peso.recruitment.offcanvas-recruitment')
            </div>
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

                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                    editor.on('change', function (e) {
                    @this.set('details', editor.getContent());
                    });
                },

            });
        });

    </script>
    @endscript
</div>
