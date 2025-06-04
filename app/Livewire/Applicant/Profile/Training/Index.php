<?php

namespace App\Livewire\Applicant\Profile\Training;

use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\ApplicantProfileTraining;

class Index extends Component
{
    #[Locked]
    public $profile_id, $activeTraining;

    public $name, $date_start, $date_end, $institution, $certificate;
    public $action;
    public $trainings;

    protected $rules = [
        'name' => 'required|string',
        'date_start' => 'required|date',
        'date_end' => 'required|date',
        'institution' => 'required|string',
        'certificate' => 'required|string',
    ];

    public function resetfields()
    {
        $this->reset('name', 'date_start', 'date_end', 'institution', 'certificate');
    }

    private function setTraining($id)
    {
        $this->activeTraining = ApplicantProfileTraining::findorfail($id);
        $this->name = $this->activeTraining->name;
        if ($this->activeTraining->date_start) {
            $this->date_start = $this->activeTraining->date_start->format('Y-m-d');
        }
        if ($this->activeTraining->date_end) {
            $this->date_end = $this->activeTraining->date_end->format('Y-m-d');
        }
        $this->institution = $this->activeTraining->institution;
        $this->certificate = $this->activeTraining->certificate;
    }

    public function confirmDeleteTraining($id)
    {
        try {
            $this->setTraining($id);
            $this->action = "deleteTraining";
            $this->dispatch('toggle-offcanvas', id: 'offcanvasTraining');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }

    }

    public function deleteTraining()
    {
        try {
            $this->activeTraining->delete();
            session()->flash('error', 'Training record deleted successfully.');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasTraining');
    }


    public function updateTraining()
    {
        $validated = $this->validate();
        try {
            $this->activeTraining->update($validated);
            session()->flash('status', 'Your trainings record has been updated successfully.');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasTraining');
    }

    public function editTraining($id)
    {
        try {
            $this->setTraining($id);
            $this->action = "updateTraining";
            $this->dispatch('toggle-offcanvas', id: 'offcanvasTraining');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }

    }

    public function saveTraining()
    {
        $validated = $this->validate();
        try {
            $Training = new ApplicantProfileTraining($validated);
            $Training->applicant_profile_id = $this->profile_id;
            $Training->save();
            session()->flash('status', 'Your trainings record has been updated successfully.');
            $this->resetfields();
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasTraining');
    }

    public function addTraining()
    {
        $this->resetfields();
        $this->action = 'saveTraining';

    }

    public function mount($id)
    {
        $this->profile_id = $id;
    }

    public function render()
    {
        $this->trainings = ApplicantProfileTraining::where('applicant_profile_id', $this->profile_id)->orderBy('name')->get();
        return view('livewire.applicant.profile.training.index');
    }
}
