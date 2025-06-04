<?php

namespace App\Livewire\Employer\Vacancy;

use App\Models\EmployerProfile;
use App\Models\SubSpecialization;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Archive extends Component
{
    public  $status ='deleted', $company;

    public function mount()
    {
        $this->employer = EmployerProfile::where('user_id', '=', Auth::user()->id)->first();
        if ($this->employer != null) {
            $this->company = $this->employer->company;
        }
    }

    public function render()
    {
        return view('livewire.employer.vacancy.archive')
            ->layout('components.layouts.portal', ['header'=> 'Job Vacancy Archive', 'subheader' => 'A list of your previous job vacancy postings.']);;
    }
}
