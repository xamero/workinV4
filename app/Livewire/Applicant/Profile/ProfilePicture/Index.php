<?php

namespace App\Livewire\Applicant\Profile\ProfilePicture;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithFileUploads;

    public $photo;

    public $uploadPhotoModal;

    public function updatePhoto(){
        try {
            $this->validate([
                'photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            ]);

            Auth::user()->updateProfilePhoto($this->photo);

            session()->flash('status', 'Your profile photo has been updated.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.applicant.profile.profile-picture.index');
    }
}
