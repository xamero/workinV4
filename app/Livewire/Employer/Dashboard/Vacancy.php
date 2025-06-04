<?php

namespace App\Livewire\Employer\Dashboard;

use App\Models\EmployerProfile;
use App\Models\SubSpecialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Vacancy as VacancyModel;


class Vacancy extends Component
{

    #[Locked]
    public $company, $employer, $vacancies;

    public $action, $subspecializations;

    public $title, $details, $sub_specialization_id, $job_type, $location, $salary_from, $salary_to, $total_vacancy, $is_public;


    protected $rules = [
        'title' => 'required|string',
        'details' => 'required|string',
        'sub_specialization_id' => 'required|numeric',
        'job_type' => 'required|string',
        'location' => 'required|string',
        'salary_from' => 'required|numeric',
        'salary_to' => 'nullable|numeric',
        'total_vacancy' => 'required|numeric'
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'sub_specialization_id' => 'category (specialization)',
        'job_type' => 'job type',
        'location' => 'place of assignment',
        'salary_from' => 'salary range from',
        'salary_to' => 'salary range to',
        'total_vacancy' => 'total vacancy'
    ];

    #[On('saveVacancy')]
    public function saveVacancy()
    {

        $validated = $this->validate();

        try {
            $vacancy = new \App\Models\Vacancy($validated);
            $vacancy->company_id = $this->company->id;
            $vacancy->save();
            Session::flash("success", "Job vacancy has been posted successfully.");
        } catch (\Exception $exception) {

            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }

    public function mount()
    {
        $this->action = 'saveVacancy';
        $this->dispatch('show-tinyMce');
        $this->subspecializations = SubSpecialization::all();
    }

    public function render()
    {
        $this->employer = EmployerProfile::where('user_id', '=', Auth::user()->id)->first();
        if ($this->employer != null) {
            $this->company = $this->employer->company;
            $this->vacancies = VacancyModel::orderby('created_at', 'desc')
                ->where('company_id', '=', $this->company->id)->limit(5)->get();
        }

        return view('livewire.employer.dashboard.vacancy');
    }

}
