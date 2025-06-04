<div>
    <div class="card">
        <div class="card-header text-center">
            Accounts
        </div>
        <div class="card-body">
            <p class="text-primary">Total Accounts: {{ number_format($counts->total_count   ?? '0') }}</p>
            <p class=" text-primary ">Created Today: {{ number_format($counts->created_today ?? '0')}}</p>
            <p class=" text-primary ">Created this Month: {{ number_format($counts->created_this_month ?? '0')}}</p>
            <p class=" text-primary ">Created this Year: {{ number_format($counts->created_this_year ?? '0')}}</p>
        </div>
    </div>
</div>
