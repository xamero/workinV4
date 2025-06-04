<?php

namespace App\Livewire\Applicant\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vacancy as VacancyModel;

class Vacancy extends Component
{
    use WithPagination;
    
    public $vacancies;
    public $perPage = 7;
    public $companyId;
    
    public function mount($id){
        $this->companyId = $id;
    }
    
    public function loadMore(){
        $this->perPage = $this->perPage + 7;
    }
    
    public function render()
    {
        $this->vacancies = VacancyModel::where('company_id', $this->companyId)
        ->with('subSpecialization')
        ->orderBy('created_at')
        ->get()
        ->take($this->perPage);
        
        return view('livewire.applicant.company.vacancy');
    }
}
