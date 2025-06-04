<?php

namespace App\Livewire\Peso\Company;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Locked]
    public $company;

    public $company_code, $action, $name, $email, $address, $contact_number, $logo, $company_overview, $photo;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'address' => 'required|string',
        'contact_number' => 'required|numeric',
//        'logo' => 'nullable|numeric',
        'photo' => 'image|max:1024|nullable',
        'company_overview' => 'required|string'
    ];

    protected $messages = [

    ];

    protected $validationAttributes = [
        'contact_number' => 'contact number',
        'company_overview' => 'company overview'
    ];

    private function setValues($rowId)
    {
        $this->company_code = $rowId['company_code'];
        $this->name = $rowId['name'];
        $this->email = $rowId['email'];
        $this->address = $rowId['address'];
        $this->contact_number = $rowId['contact_number'];
        $this->logo = $rowId['logo'];
        $this->company_overview = $rowId['company_overview'];
        $this->dispatch('show-tinyMce');
        $this->dispatch('toggle-offcanvas', id: 'offcanvasCompany');
        $this->company = Company::findorfail($rowId['id']);
    }

    #[On('delete')]
    public function deleteCompany($rowId): void
    {
        $this->setValues($rowId);
        $this->action = 'confirmDelete';
    }

    public function confirmDelete()
    {
        try {
            $this->company->delete();
            Session::flash("error", $this->company->name . " has been deleted and will no longer appear in searches.");
            $this->dispatch('RefreshComponent');
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCompany');
        } catch (\Exception $exception) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }

    #[On('edit')]
    public function editCompany($rowId): void
    {
        $this->setValues($rowId);
        $this->action = 'updateCompany';
    }

    public function updateCompany()
    {

        $validated = $this->validate();
        try {

            $this->company->update($validated);
            if ($this->photo) {
                $this->logo = Str::random(20) . '.' . $this->photo->getClientOriginalExtension();
                $this->photo->storeAs('company', $this->logo);
                $this->company->logo = $this->logo;
                $this->company->save();
            }
            Session::flash("success", "Company details updated successfully.");
            $this->dispatch('RefreshComponent');
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCompany');
//            $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasCompany")).toggle();');
        } catch (\Exception $exception) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }


    #[On('add')]
    public function addCompany(): void
    {
        $this->refresh();
        $this->dispatch('show-tinyMce');
        $this->dispatch('toggle-offcanvas', id: 'offcanvasCompany');
        $this->action = "saveCompany";
    }


    public function saveCompany()
    {
        $validated = $this->validate();
        try {
            $company = new Company($validated);
            $company->user_id = '1';
            $company->company_code = substr(uniqid(), 0, 10);
            if ($this->photo) {
                $this->logo = Str::random(20) . '.' . $this->photo->getClientOriginalExtension();
                $this->photo->storeAs('company', $this->logo);
                $company->logo = $this->logo;
            }
            $company->save();
            Session::flash("success", $this->name . " with company code " . $company->company_code . " was added successfully.");
            $this->dispatch('RefreshComponent');
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCompany');
        } catch (\Exception $exception) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }

    }


    private function refresh()
    {
        $this->reset(['company_code', 'action', 'name', 'email', 'address', 'contact_number', 'logo', 'company_overview', 'photo']);
    }

    public function render()
    {
        return view('livewire.peso.company.index')->layout('components.layouts.portal', ['header' => 'List of companies']);
    }
}
