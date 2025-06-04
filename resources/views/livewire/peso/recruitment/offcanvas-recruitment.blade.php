<div wire:ignore.self class="offcanvas w-100 offcanvas-start" tabindex="-1"
     id="offcanvasRecruitment">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary display-6 " id="offcanvasWithBothOptionsLabel">Recruitment Activity</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        @if($action == 'deleteActivity')
            <div class="alert alert-danger">
                Please confirm whether you wish to delete this record. Note that changes are irreversible. Scroll
                down to proceed or click the 'Cancel' button (X) to abort.
            </div>
        @endif

        <form wire:submit="{{$action}}">
            <fieldset {{$status == false ? 'disabled':''}}>
                <div class="row my-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Type</x-label>
                        <select wire:model="type" class="form-control"
                                class="{{$errors->has('type') ? 'is-invalid':''}}">
                            <option value="" selected></option>
                            <option value="Local Recruitment Activity" {{$type == 'Local Recruitment Activity' ? 'selected':''}}>Local Recruitment Activity</option>
                            <option value="Special Recruitment Activity" {{$type == 'Special Recruitment Activity' ? 'selected':''}}>Special Recruitment Activity</option>
                            <option value="Job Fair" {{$type == 'Job Fair' ? 'selected':''}}>Job Fair</option>
                            <option value="DMW Caravan" {{$type == 'DMW Caravan' ? 'selected':''}}>DMW Caravan</option>
                        </select>
{{--                        <x-input type="input" wire:model="type"--}}
{{--                                 class="{{$errors->has('type') ? 'is-invalid':''}}"></x-input>--}}
                        @error('type')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>

                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Start</x-label>
                        <x-input type="datetime-local" wire:model="start"
                                 class="{{$errors->has('start') ? 'is-invalid':''}}"></x-input>
                        @error('start')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label>End</x-label>
                        <x-input type="datetime-local" wire:model="end"
                                 class="{{$errors->has('end') ? 'is-invalid':''}}"></x-input>
                        @error('end')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical class="col-md-12">
                        <x-label class="required">Venue</x-label>
                        <x-input type="text" wire:model="venue"
                                 class="{{$errors->has('end') ? 'is-invalid':''}}"></x-input>
                        @error('end')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3">
                    <x-form-panel-vertical>
                        <x-label class="required">Participating Companies (Separate with comma and select from the suggestions)</x-label>
                        <textarea class="form-control" wire:keyup="updateQuery" wire:model="companies" >{{$companies}}</textarea>
                        @error('companies')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                        @if (!empty($suggestions))
                            <ul class="list-group mt-2">
                                @foreach ($suggestions as $suggestion)
                                    <li class="list-group-item pointer"
                                        wire:click="selectCompany('{{ $suggestion['name']}}')">
                                        {{ $suggestion['name'] }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </x-form-panel-vertical>
                </div>
                <div class="row mb-3" wire:ignore>
                    <div class="col">
                        <x-label class="required">Details</x-label>
                        <textarea wire:model="details" id="detalye" cols="30" rows="10"
                                  class="form-control {{$errors->has('details') ? 'is-invalid':''}}" ></textarea>
                        @error('details')
                        <x-slot name="message">{{$message}}</x-slot>
                        @enderror
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3" {{$status == false ? 'hidden':''}}>
                <div class="col-md-12">
                    <p>By continuing, you confirm that you have read and agree to our <a href="">Privacy Policy.</a>.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="col d-flex justify-content-end">
                        <x-button class="{{$action == 'deleteActivity' ? 'btn-danger':'btn-primary'}}" type="submit" >
                        <span wire:loading wire:target="{{$action}}">
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Processing...
                        </span>
                            <span wire:loading.remove wire:target="{{$action}}">
                   <x-awesome.save></x-awesome.save> {{$action == 'deleteActivity' ? 'Continue':'Save'}}</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


