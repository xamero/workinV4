<?php

namespace App\Livewire\Peso\Applicants;

use App\Models\ApplicantProfile;
use App\Models\JobApplication;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Profile extends Component
{
    #[Locked]
    public $vacancy_id, $vacancy, $company, $user;

    public $applicant, $applicant_id, $subject, $emailto, $replyto, $inviDetails, $application, $action;
    public function mount()
    {
//        $this->user = Auth::user();
//        $user_company_id = $this->user->employer_profile->company_id;


        $this->vacancy = Vacancy::where('id', '=', $this->vacancy_id)
//            ->where('company_id', $user_company_id)
            ->withTrashed()
            ->first();


        $this->company = $this->vacancy->company;

        $this->applicant = ApplicantProfile::where('id', '=', $this->applicant_id)
            ->first();

        $this->application = JobApplication::where('vacancy_id', $this->vacancy_id)
            ->where('applicant_profile_id', $this->applicant_id)
//            ->whereHas('vacancy', function ($query) use ($user_company_id) {
//                $query->where('company_id', $user_company_id)->withTrashed();
//            })
            ->orderBy('created_at', 'desc')
            ->first();

//        dd($this->application);

        $this->emailto = $this->applicant->user->email;
        $this->replyto = Auth::user()->email;
        $this->action = 1;

        $this->dispatch('show-tinyMce');
    }
    public function render()
    {
        return view('livewire.peso.applicants.profile')->layout('components.layouts.portal');
    }
}
