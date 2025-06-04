<?php

namespace App\Livewire\Applicant\Application;

use App\Models\Vacancy;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;

class ApplicationDetail extends Component
{

    #[Locked]
    public $activeApplication;

    public function withdrawApplication($id){
        try {
            $profile = Auth::user()->profile()->first();
            $profile->application()->detach($id);
            session()->flash('success', 'Your application has been withdraw.');
        } catch (QueryException $e) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }

    public function  mount($id)
    {
        $this->activeApplication = Vacancy::where('id', $id)->whereHas('applicantProfile', function($query){
            $query->where('applicant_profile_vacancy.applicant_profile_id', Auth::user()->applicant_profile->id);
        })->with('applicantProfile')->first();
    }
    
    public function render()
    {
        return view('livewire.applicant.application.application-detail');
    }
}
