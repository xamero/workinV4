<?php

namespace App\Livewire\Peso\Vacancy;

use App\Models\Company;
use App\Models\EmployerProfile;
use App\Models\SubSpecialization;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    #[Locked]
    public  $vacancy, $companies;

    public $action, $subspecializations;

    public $title, $details, $sub_specialization_id, $job_type, $location, $salary_from, $salary_to,
        $total_vacancy, $is_public, $applicant_counter, $status = '', $company_id;

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

    #[On('edit')]
    public function editVacancy($rowId): void
    {
        $this->title = $rowId['title'];
        $this->details = $rowId['details'];
        $this->location = $rowId['location'];
        $this->salary_from = $rowId['salary_from'];
        $this->salary_to = $rowId['salary_to'];
        $this->job_type = $rowId['job_type'];
        $this->sub_specialization_id = $rowId['sub_specialization_id'];
        $this->total_vacancy = $rowId['total_vacancy'];
        $this->dispatch('show-tinyMce');
        $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasEdit")).toggle();');
        $this->vacancy = Vacancy::findorfail($rowId['id']);
        $this->action = 'updateVacancy';
    }


    public function updateVacancy()
    {
        $validated = $this->validate();
        try {
            $this->vacancy->update($validated);
            Session::flash("success", "Job vacancy has been updated successfully.");
            $this->dispatch('RefreshComponent');
        } catch (\Exception $exception) {

            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }

    #[On('confirmDelete')]
    public function confirmDelete($rowId): void
    {
        $this->dispatch('show-tinyMce');
        $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasEdit")).toggle();');
        $this->title = $rowId['title'];
        $this->details = $rowId['details'];
        $this->location = $rowId['location'];
        $this->salary_from = $rowId['salary_from'];
        $this->salary_to = $rowId['salary_to'];
        $this->job_type = $rowId['job_type'];
        $this->sub_specialization_id = $rowId['sub_specialization_id'];
        $this->total_vacancy = $rowId['total_vacancy'];
        $this->vacancy = Vacancy::findorfail($rowId['id']);
        $this->applicant_counter = $rowId['applicant'];
        $this->action = 'deleteVacancy';
    }

    public function deleteVacancy()
    {
        try{
            if($this->applicant_counter > 0 ){
                $this->vacancy->delete();
                Session::flash("error", "Job vacancy has been moved to archive and will no longer appear to searches.");
            }else{
                $this->vacancy->forcedelete();
                Session::flash("error", "Job vacancy has been permanently deleted.");
            }

            $this->dispatch('RefreshComponent');

        }catch (\Exception $exception)
        {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }

    #[On('add')]
    public function add()
    {
        $this->dispatch('show-tinyMce');
        $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasEdit")).toggle();');
        $this->action = 'saveVacancy';
    }

    public function saveVacancy()
    {
        $validated = $this->validate();
        try {
            $vacancy = new Vacancy($validated);
            $vacancy->company_id = $this->company_id;
            $vacancy->save();
            Session::flash("success", "The job vacancy has been successfully posted.");
            $this->dispatch('RefreshComponent');
        } catch (\Exception $exception) {

            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }


    public function mount()
    {
        $this->action = 'updateVacancy';
        $this->subspecializations = SubSpecialization::all();
        $this->companies = Company::orderby('name')->get();

    }

    public function render()
    {
        return view('livewire.peso.vacancy.index')
            ->layout('components.layouts.portal', ['header' => 'Vacancies', 'subheader' => 'Displaying all job vacancies.']);
    }
}
