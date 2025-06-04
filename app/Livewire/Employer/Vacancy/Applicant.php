<?php

namespace App\Livewire\Employer\Vacancy;

use App\Livewire\Employer\Dashboard\Vacancy;
use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Vacancy as ModelVacancy;

class Applicant extends Component
{
    #[Locked]
    public $employer, $company, $vacancy;

    public $vacancy_id;


//    #[On('quickList')]
//    public function quickList($row): void
//    {
//        $this->vacancy = ModelVacancy::where('id','=',$row['id'])
//            ->with(['applicantProfile' => function ($query) {
//                $query->orderby('surname', 'ASC');
//            }])->first();
////        dd($this->vacancy->applicantProfile);
////        $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasQuickList")).toggle();');
//    }

    public function mount()
    {
        $this->vacancy = ModelVacancy::where('id','=',$this->vacancy_id)
            ->first();
        $this->employer = EmployerProfile::where('user_id', '=', Auth::user()->id)->first();
        if ($this->employer != null) {
            $this->company = $this->employer->company;
        }
    }

    public function render()
    {
        return view('livewire.employer.vacancy.applicant')
            ->layout('components.layouts.portal', ['header' =>'List of applicants']);
    }
}
