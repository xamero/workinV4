<div>
    {{ Breadcrumbs::render('employer.dashboard') }}
    <livewire:employer.profile.index :key="time()"/>
    <livewire:employer.company.index :key="time()"/>
{{--    <livewire:employer.dashboard.vacancy :key="time()"/>--}}

</div>
