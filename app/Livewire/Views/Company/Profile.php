<?php

namespace App\Livewire\Views\Company;

use App\Models\Company;
use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
//    #[Reactive]
    public $company_id;

    public $company;


//    #[On('companyProfileRefresh')]
//    public function  companyProfileRefresh()
//    {
//        dd('tell me');
//        $this->company = Company::findOrFail($this->company_id);
//    }
    public function mount()
    {
        $this->company = Company::findOrFail($this->company_id);
    }

    public function render()
    {
        return view('livewire.views.company.profile');
    }
}
