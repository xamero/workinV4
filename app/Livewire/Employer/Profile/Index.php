<?php

namespace App\Livewire\Employer\Profile;

use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{

    #[Locked]
    public $profile;

    public $prefix, $firstname, $surname, $position, $contact_number;
    public $action;


    protected $rules = [
        'prefix' => 'required|string',
        'firstname' => 'required|string',
        'surname' => 'required|string',
        'position' => 'required|string',
        'contact_number' => 'required|numeric'
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'contact_number' => 'contact number'
    ];


    public function resetfields()
    {
        $this->reset(['prefix', 'firstname','surname', 'position', 'contact_number']);
    }

    public function updateProfile()
    {
        $validated = $this->validate();
        try {
            $profile =  $this->profile->update($validated);
            session()->flash('status', 'Your profile has been updated.');
        } catch (\Exception $exception) {
            dd($exception);
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }


    public function saveProfile()
    {
        $validated = $this->validate();

        try {
            $profile = new EmployerProfile($validated);
            $profile->employer_id = uniqid();
            $profile->user_id = Auth::user()->id;
            $profile->save();
            $this->dispatch('profileAdded');
            session()->flash('status', 'Your profile has been updated.');
        } catch (\Exception $exception) {
            dd($exception);
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }

    public function addProfile()
    {
        $this->action = 'saveProfile';
        if ($this->profile != null) {
            $this->prefix = $this->profile->prefix;
            $this->firstname = $this->profile->firstname;
            $this->surname = $this->profile->surname;
            $this->position = $this->profile->position;
            $this->contact_number = $this->profile->contact_number;
            $this->action = 'updateProfile';
        }
    }


    public function mount()
    {

    }

    public function render()
    {
        $this->profile = EmployerProfile::where('user_id', '=', Auth::user()->id)->first();
        return view('livewire.employer.profile.index');
    }
}
