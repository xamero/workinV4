<div>
    <div class="container-fluid">


        <div class="row my-5">
            <div class="col-md-8  mx-auto">
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
                <div class="p-5 bg-white  rounded  border ">
                    <div class="bg-secondary-subtle mt-3 rounded">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" wire:ignore>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Application Letter
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile"
                                        aria-selected="false">Resume
                                </button>
                            </li>
                            <li class="nav-item float-end" role="presentation">
                                <button class="nav-link" id="pills-action-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-action" type="button" role="tab"
                                        aria-controls="pills-action"
                                        aria-selected="false">Action
                                </button>
                            </li>

                        </ul>
                    </div>

                    <div class="tab-content p-5" id="pills-tabContent" wire:ignore>
                        <div class="tab-pane fade show active " id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab" tabindex="0">
                            @if($application->cover_letter != null)
                                <p>{!!  $application->cover_letter!!}</p>
                            @endif
                        </div>
                        <div class="tab-pane fade " id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab"
                             tabindex="0">
                            <livewire:views.applicants.resume :applicant_id='$applicant_id'/>
                        </div>
                        <div class="tab-pane fade " id="pills-action" role="tabpanel"
                             aria-labelledby="pills-action-tab"
                             tabindex="0">
                            <div class="row mb-5">
                                <div class="col">
                                    <x-button class="btn-primary" wire:click="invite">Invite to interview</x-button>
                                    <x-button class="btn-lite-danger" wire:click="reject">Send rejection letter
                                    </x-button>
                                </div>
                            </div>
                            <form method="post" wire:submit="sendEmail">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="alert alert-info alert-important small">An email will be sent to the
                                            applicant
                                            on your
                                            behalf. A
                                            carbon-copy
                                            will also be sent to your email.
                                            <br>
                                            All fields marked with <span class="text-danger">*</span> are
                                            required.
                                            Please
                                            fill up with the most appropriate data.
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <x-form-panel-vertical class="col-md-6">
                                        <x-label class="required">Subject</x-label>
                                        <x-input type="text" wire:model="subject" required/>
                                    </x-form-panel-vertical>
                                </div>
                                <div class="row mb-3">
                                    <x-form-panel-vertical class="col-md-6">
                                        <x-label class="required">Email-to</x-label>
                                        <x-input type="text" wire:model="emailto" required/>
                                    </x-form-panel-vertical>
                                    <x-form-panel-vertical class="col-md-6">
                                        <x-label class="required">CC/Reply-to</x-label>
                                        <x-input type="text" wire:model="replyto" required/>
                                    </x-form-panel-vertical>
                                </div>
                                <div class="row mb-3" wire:ignore>
                                    <x-form-panel-vertical class="col-md-12">
                                        <x-label for="details" class="required">Body</x-label>
                                        <textarea wire:model="inviDetails" id="detalye"
                                                  class="form-control format  @if( $errors->updateVacancy->first('details')) is-invalid @endif"
                                                  required>
                                        </textarea>
                                    </x-form-panel-vertical>
                                </div>
                                <div class="row">
                                    <div class="col ">
                                        <x-button class="btn-primary float-end">
                                        <span wire:loading wire:target="sendEmail">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            Sending...
                                        </span>
                                            <span wire:loading.remove wire:target="sendEmail">Send</span></x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                @this.set('inviDetails', editor.getContent());
                });
            },

        });
    });

</script>
@endscript
</div>
