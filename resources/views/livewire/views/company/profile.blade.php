<div>
    <div class="container"
        @if($company != null)
            <div class="row" >
                <div class="col-md-4">
                    @if($company->logo != null)
                        <img src="{{asset('storage/company/'.  $company->logo)}}"
                             class="mb-3 " alt="" style="max-width: 8rem">
                    @endif
                    <p class="lead mb-0">{{$company->name}}</p>
                    <p class="mb-0">Address: {{$company->address}}</p>
                    <p class="mb-0">Contact Number: {{$company->contact_number}}</p>
                    <p>Company Code: {{$company->company_code}}</p>
                </div>
                <div class="col-md-8 border p-3 rounded" style="max-height: 20rem; overflow:scroll">
                    {!! $company->company_overview !!}
                </div>
            </div>

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
</div>
