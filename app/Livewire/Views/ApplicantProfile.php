<?php

namespace App\Livewire\Views;

use Livewire\Component;
use App\Models\ApplicantProfile as Profile;

class ApplicantProfile extends Component
{
    private $profile;

    public function mount($profile_id)
    {
        $this->profile = Profile::findOrFail($profile_id);
    }

    public function render()
    {
        return view('livewire.views.applicant-profile');
    }
}
