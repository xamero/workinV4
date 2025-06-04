<?php

namespace App\Livewire\Employer\Company;

use App\Models\Company;
use App\Models\EmployerProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{
    #[Locked]
    public $company, $employer;

    public $company_code, $action, $name, $email, $address, $contact_number, $logo, $company_overview;

    protected $rules = [
        'name' => 'required|string',
        'address' => 'required|string',
        'email' => 'required|string|email',
        'contact_number' => 'required|numeric',
        'company_overview' => 'required|string',
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'name' => 'company name',
        'contact_number' => 'contact number',
        'company_overview' => 'company overview',
    ];


    public function edit()
    {
//        $this->dispatch('companyProfileRefresh');
        $this->action = 'update';
        $this->dispatch('toggle-offcanvas', id: 'offcanvasCompanyProfile');
//        $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasCompanyProfile")).show();');
//        $this->dispatch('show-tinyMce');
    }

    public function update()
    {
        $validated = $this->validate();
        try {
            $this->company->update($validated);
            Session::flash("success", "Job vacancy has been updated successfully.");
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCompanyProfile');
            $this->dispatch('company-profile-refresh');

        } catch (\Exception $exception) {

            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }


    public function connect()
    {
        if ($this->employer != null) {
            $company = Company::where('company_code', '=', $this->company_code)->first();
            if ($company != null) {
                try {
                    $this->employer->company_id = $company->id;
                    $this->employer->save();
                    session()->flash('status', "We've successfully connected you account.");
                } catch (\Exception $exception) {
                    session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
                }
            } else {
                session()->flash('error', "Please verify your company code, we can't find it on our list");
            }
        } else {
            session()->flash('error', 'Ooops, you need to set you profile first.');
        }
    }


    public function render()
    {
        $this->employer = EmployerProfile::where('user_id', '=', Auth::user()->id)
            ->first();

        if ($this->employer != null) {

            $this->company = $this->employer->company;
            $this->name = $this->company->name ?? '';
            $this->email = $this->company->email ?? '';
            $this->address = $this->company->address ?? '';
            $this->contact_number = $this->company->contact_number ?? '';
            $this->company_overview = $this->company->company_overview ?? '';
        }
        return view('livewire.employer.company.index')
            ->layout('components.layouts.portal', ['header' => 'Company Profile', 'subheader' => 'Manage your company profile.']);
    }
}
