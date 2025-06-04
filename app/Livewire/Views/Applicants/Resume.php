<?php

namespace App\Livewire\Views\Applicants;

use App\Models\ApplicantProfile;
use Livewire\Component;

class Resume extends Component
{
    public $applicant_id, $applicant;

    public function  mount()
    {
        $this->applicant = ApplicantProfile::where('id','=', $this->applicant_id)->first();
    }

    public function render()
    {
        return view('livewire.views.applicants.resume');
    }
}
