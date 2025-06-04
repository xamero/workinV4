<?php

namespace App\Livewire\Peso\Vacancy;

use App\Models\EmployerProfile;
use App\Models\Vacancy as ModelVacancy;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Applicant extends Component
{
    #[Locked]
    public $employer, $company, $vacancy;

    public $vacancy_id;

    public function mount()
    {
        $this->vacancy = ModelVacancy::where('id','=',$this->vacancy_id)
            ->first();
//        $this->employer = EmployerProfile::where('user_id', '=', Auth::user()->id)->first();
//        if ($this->employer != null) {
//            $this->company = $this->employer->company;
//        }
    }

    public function render()
    {
        return view('livewire.peso.vacancy.applicant')
            ->layout('components.layouts.portal', ['header' => 'List of applicants']);
    }
}
