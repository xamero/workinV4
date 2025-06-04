<div>
    <div class="card">
        <div class="card-header text-center">
            Login
        </div>
        <div class="card-body">
            <p class="text-primary">Logged-in Today: {{number_format( $login_counter->total_today ?? 0)}} </p>
            <p class="text-primary">Logged-in this Month: {{number_format( $login_counter->total_this_month ?? 0)}} </p>
            <p class="text-primary">Logged-in this Year: {{number_format( $login_counter->total_this_year ?? 0)}} </p>
        </div>
    </div>
</div>
