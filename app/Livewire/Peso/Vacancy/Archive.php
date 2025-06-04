<?php

namespace App\Livewire\Peso\Vacancy;

use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Archive extends Component
{

    public  $status ='deleted', $company;

    public function mount()
    {
//        $this->employer = EmployerProfile::where('user_id', '=', Auth::user()->id)->first();
//        if ($this->employer != null) {
//            $this->company = $this->employer->company;
//        }
    }


    public function render()
    {
        return view('livewire.peso.vacancy.archive')
            ->layout('components.layouts.portal', ['header'=> 'Job Vacancy Archive', 'subheader' => 'A list of previous job vacancy postings.']);
    }
}
