<?php

namespace App\Livewire\Applicant\Profile\WorkExperience;

use App\Models\ApplicantProfileWorkExperience;
use Livewire\Attributes\Locked;
use Livewire\Component;


class Index extends Component
{

    #[Locked]
    public $profile_id, $activeWork;

    public $works;

    public $company, $address, $position, $status, $date_started, $date_ended, $job_description;
    public $action;


    protected $rules = [
        'company' => 'required|string',
        'address' => 'required|string',
        'position' => 'required|string',
        'date_started' => 'required|date',
        'date_ended' => 'nullable',
        'status' => 'required|string',
        'job_description' => 'nullable',
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'job_description' => 'job description'
    ];

    public function setWorkExperience($id)
    {
        $this->activeWork = ApplicantProfileWorkExperience::where('id', '=', $id)->first();
        $this->company = $this->activeWork->company;
        $this->address = $this->activeWork->address;
        $this->position = $this->activeWork->position;
        $this->status = $this->activeWork->status;
        if($this->activeWork->date_started){
            $this->date_started = $this->activeWork->date_started->format('Y-m-d');
        }
        if($this->activeWork->date_ended){
            $this->date_ended = $this->activeWork->date_ended->format('Y-m-d');
        }
        $this->job_description = $this->activeWork->job_description;
    }

    public function confirmDeleteWorkExperience($id)
    {
        $this->setWorkExperience($id);
        $this->action = 'deleteWorkExperience';
        $this->dispatch('toggle-offcanvas', id: 'offcanvasWorkExperience');
    }

    public function deleteWorkExperience()
    {
        try {
            $this->activeWork->delete();
            session()->flash('error',   'Work experience deleted successfully.');
            $this->dispatch('toggle-offcanvas', id: 'offcanvasWorkExperience');
            $this->resetFields();
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }

    public function editWorkExperience($id)
    {
        $this->setWorkExperience($id);
        $this->action = 'updateWorkExperience';
        $this->dispatch('toggle-offcanvas', id: 'offcanvasWorkExperience');

    }

    public function updateWorkExperience()
    {
        $validated = $this->validate();
        try {
            $this->activeWork->company = $this->company;
            $this->activeWork->address = $this->address;
            $this->activeWork->position = $this->position;
            $this->activeWork->status = $this->status;
            $this->activeWork->date_started = $this->date_started;
            $this->activeWork->date_ended = $this->date_ended;
            $this->activeWork->job_description = $this->job_description;
            $this->activeWork->save();
            session()->flash('status', 'Your work experience has been successfully updated.');
            $this->dispatch('toggle-offcanvas', id: 'offcanvasWorkExperience');
            $this->resetFields();
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }

    }

    public function addWorkExperience()
    {
        $this->action = 'saveWorkExperience';
        $this->resetFields();
    }

    public function saveWorkExperience()
    {
        $validated = $this->validate();
        try {
            $work = new ApplicantProfileWorkExperience();
            $work->personal_profile_id = $this->profile_id;
            $work->company = $this->company;
            $work->address = $this->address;
            $work->position = $this->position;
            $work->status = $this->status;
            $work->date_started = $this->date_started;
            $work->date_ended = $this->date_ended;
            $work->job_description = $this->job_description;
            $work->save();
            session()->flash('status', 'Your work experience has been successfully updated.');
            $this->dispatch('toggle-offcanvas', id: 'offcanvasWorkExperience');
            $this->resetFields();
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }

    }


    private function resetFields()
    {
        $this->reset(['company', 'address', 'position', 'status', 'date_started', 'date_ended', 'job_description']);
    }


    public function mount($id)
    {
        $this->profile_id = $id;
        $this->action = 'saveWorkExperience';

    }

    public function render()
    {
        $this->works = ApplicantProfileWorkExperience::where('personal_profile_id', '=', $this->profile_id)->get();
        return view('livewire.applicant.profile.work-experience.index');
    }
}
