
<div>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-md-12">
                <livewire:views.vacancies.all-vacancies-table/>
                @include('livewire.peso.vacancy.offcanvas-edit' )
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
