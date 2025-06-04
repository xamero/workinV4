<?php

namespace App\Livewire\Applicant\Profile\EducationalBackground;

use App\Models\ApplicantProfileEducationalBackground;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{
    #[Locked]
    public $profile_id, $activeEduc;

    public $level, $school, $course, $year_graduated, $highlights;
    public $action, $educations;


    protected $rules = [
        'level' => 'required',
        'school' => 'required|string',
        'course' => 'nullable|string',
        'year_graduated' => 'required|digits:4|integer',
        'highlights' => 'nullable|string',
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'year_graduated' => 'year graduated'
    ];


    public function resetfields()
    {
        $this->reset(['level', 'school', 'course', 'year_graduated', 'highlights']);
    }

    public function setEducationBackground($id)
    {
        $this->activeEduc = ApplicantProfileEducationalBackground::findorfail($id);
        $this->level = $this->activeEduc->level;
        $this->school = $this->activeEduc->school;
        $this->course = $this->activeEduc->course;
        $this->year_graduated = $this->activeEduc->year_graduated;
        $this->highlights = $this->activeEduc->highlights;
    }

    public function confirmDeleteEducationalBackground($id)
    {
        $this->setEducationBackground($id);
        $this->dispatch('toggle-offcanvas', id: 'offcanvasEducationalBackground');
        $this->action = "deleteEducationalBackground";
    }
    public function deleteEducationalBackground()
    {
        try {
            $this->activeEduc->delete();
            session()->flash('error', 'Education background deleted successfully.');
            $this->resetfields();
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasEducationalBackground');
    }

    public function updateEducationalBackground()
    {
        $validated = $this->validate();
        try {
            $this->activeEduc->update($validated);
            $this->resetfields();
            session()->flash('status', 'Your educational background has been updated.');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasEducationalBackground');
    }

    public function editEducationalBackground($id)
    {
        $this->action = 'updateEducationalBackground';
        $this->setEducationBackground($id);
        $this->dispatch('toggle-offcanvas', id: 'offcanvasEducationalBackground');
    }

    public function saveEducationalBackground()
    {
        $validated = $this->validate();
        try {
            $educ = new ApplicantProfileEducationalBackground($validated);
            $educ->applicant_profile_id = $this->profile_id;
            $educ->save();
            $this->resetfields();
            session()->flash('status', 'Your educational background has been updated.');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasEducationalBackground');
    }


    public function addEducationalBackground()
    {
        $this->action = 'saveEducationalBackground';
    }


    public function mount($id)
    {
        $this->profile_id = $id;
    }

    public function render()
    {

        $this->educations = ApplicantProfileEducationalBackground::where('applicant_profile_id', '=', $this->profile_id)->orderby('year_graduated')->get();
        return view('livewire.applicant.profile.educational-background.index');
    }
}
