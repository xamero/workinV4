<?php

namespace App\Livewire\Peso\Widgets;

use App\Models\Vacancy;
use Livewire\Component;
use Carbon\Carbon;

class VacancyCounter extends Component
{
    public function render()
    {
        $vacancy_counter = Vacancy::selectRaw("
    COUNT(*) as total_vacancies,
    COUNT(CASE WHEN DATE(created_at) = ? THEN 1 END) as created_today,
    COUNT(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN 1 END) as created_this_month,
    COUNT(CASE WHEN YEAR(created_at) = ? THEN 1 END) as created_this_year
", [
            Carbon::today()->toDateString(),
            now()->month,
            now()->year,
            now()->year,
        ])->first();

        return view('livewire.peso.widgets.vacancy-counter', ['vacancy_counter' => $vacancy_counter]);
    }
}
