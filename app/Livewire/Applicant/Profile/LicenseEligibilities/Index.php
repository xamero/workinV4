<?php

namespace App\Livewire\Applicant\Profile\LicenseEligibilities;

use App\Models\ApplicantProfileLicenseEligibilities;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{

    #[Locked]
    public $profile_id, $activeLicense;

    public $name, $issuer, $date_of_issuance, $date_of_expiration, $description;
    public $action;


    protected $rules = [
        'name' => 'required|string',
        'issuer' => 'required|string',
        'date_of_issuance' => 'nullable|date',
        'date_of_expiration' => 'nullable|date',
        'description' => 'nullable|string'
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'name' => 'license or eligibility name',
        'issuer' => 'issuing organization',
        'date_of_issuance' => 'date of issuance',
        'date_of_expiration' => 'date of expiration',
    ];

    public function resetfields()
    {
        $this->reset('name', 'issuer', 'date_of_issuance', 'date_of_expiration', 'description');
    }

    private function setLicense($id)
    {
        $this->activeLicense = ApplicantProfileLicenseEligibilities::findorfail($id);
        $this->name = $this->activeLicense->name;
        $this->issuer = $this->activeLicense->issuer;

        if($this->activeLicense->date_of_issuance)
        {
            $this->date_of_issuance = $this->activeLicense->date_of_issuance->format("Y-m-d");
        }
        if($this->activeLicense->date_of_expiration)
        {
            $this->date_of_expiration = $this->activeLicense->date_of_expiration->format("Y-m-d");
        }
        $this->description = $this->activeLicense->description;
    }

    public function confirmDeleteLicense($id)
    {
        $this->setLicense($id);
        $this->dispatch('toggle-offcanvas', id: 'offcanvasLicensesEligibilities');
        $this->action = "deleteLicense";
    }

    public function deleteLicense()
    {
        try {
            $this->activeLicense->delete();
            session()->flash('error', 'License and eligibility deleted successfully');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasLicensesEligibilities');
    }


    public function updateLicense()
    {
        $validated = $this->validate();
        try {
            $this->activeLicense->update($validated);
            session()->flash('status', 'Your licenses and eligibility has been updated.');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasLicensesEligibilities');
    }

    public function editLicense($id)
    {
        try {
            $this->action = "updateLicense";
            $this->setLicense($id);
            $this->dispatch('toggle-offcanvas', id: 'offcanvasLicensesEligibilities');
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }

    }

    public function saveLicense()
    {
        $validated = $this->validate();
        try {
            $license = new ApplicantProfileLicenseEligibilities($validated);
            $license->applicant_profile_id = $this->profile_id;
            $license->save();
            session()->flash('status', 'Your licences and eligibility has been updated.');
            $this->resetfields();
        } catch (\Exception $exception) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasLicensesEligibilities');

    }

    public function addLicense()
    {
        $this->resetfields();
        $this->action = 'saveLicense';

    }

    public function mount($id)
    {
        $this->profile_id = $id;
    }

    public function render()
    {
        $licenses = ApplicantProfileLicenseEligibilities::orderby('name')->get();
        return view('livewire.applicant.profile.license-eligibilities.index', ['licenses' => $licenses]);
    }
}
