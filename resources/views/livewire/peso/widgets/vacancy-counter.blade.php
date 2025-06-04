<div>
    <div class="card">
        <div class="card-header text-center">
            Job Vacancy
        </div>
        <div class="card-body">
            <p class="text-primary">Total Posts: {{number_format( $vacancy_counter->total_vacancies ?? 0)}} </p>
            <p class="text-primary">Posted Today: {{number_format( $vacancy_counter->created_today ?? 0)}} </p>
            <p class="text-primary">Posted this Month: {{number_format( $vacancy_counter->created_this_month ?? 0)}} </p>
            <p class="text-primary">Posted this Year: {{number_format( $vacancy_counter->created_this_year ?? 0)}} </p>
        </div>
    </div>
</div>
