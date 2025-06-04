<?php

namespace App\Livewire\Applicant\Profile\Specialization;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\ApplicantProfile;
use App\Models\Specialization as Specialize;

class Index extends Component
{
    #[Locked]
    public $profile_id;

    public $SubSpecialization = [];
    public $Profile;
    public $Specializations;

    public function saveSpecialization(){
        try {
            $this->Profile->SubSpecialization()->sync($this->SubSpecialization);
            session()->flash('status', 'Your specialization record has been updated.');
        } catch (QueryException $e) {
            // dd($e);
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasSpecialization');
    }

    public function mount($id){
        $this->profile_id = $id;
    }

    public function render()
    {
        $this->Specializations = Specialize::with('SubSpecialization')->get();
        $this->Profile = ApplicantProfile::with('SubSpecialization')->find($this->profile_id);
        foreach($this->Profile->SubSpecialization as $SubSpecialized){
            $this->SubSpecialization[] = $SubSpecialized->id;
        }
        return view('livewire.applicant.profile.specialization.index');
    }
}
