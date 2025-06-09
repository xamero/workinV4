<div>
    {{--   {{ Breadcrumbs::render('employer.dashboard') }} --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-md-9 ">
                <div class="card bg-pilipinas p-3 mb-3 h-100 shadow-lg">
                    <div class="card-body text-white">
                        <h1 class="text-white">Welcome back, {{ Auth::user()->name }}!</h1>
                        <p class="text-white">Here’s what’s happening with your postings today.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <livewire:employer.profile.index :key="time()" />
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <livewire:employer.company.index :key="time()" />
            </div>
        </div>
    </div>

    {{--    <livewire:employer.dashboard.vacancy :key="time()"/> --}}

   

</div>
