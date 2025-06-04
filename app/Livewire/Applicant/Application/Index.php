<?php

namespace App\Livewire\Applicant\Application;

use App\Models\Vacancy;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\ApplicantProfile;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    #[Locked]
    public $applicantProfile, $applicationDetail;

    public function getApplicationDetail($id){
        $this->applicationDetail = Vacancy::find($id);
        // dd($this->applicationDetail);
    }

    #[On('removeVacancy')]
    public function removeVacancy(){
        $this->applicationDetail = null;
    }

    public function render()
    {
        $this->applicantProfile = ApplicantProfile::where('user_id', Auth::user()->id)->with('application.company', 'application.subSpecialization')->first();
        // dd($this->applicantProfile);
        return view('livewire.applicant.application.index');
    }
}
