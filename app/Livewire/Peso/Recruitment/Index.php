<?php

namespace App\Livewire\Peso\Recruitment;

use App\Models\Company;
use App\Models\RecruitmentActivity;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    #[Locked]
    public $activity;

    public $type, $start, $end, $venue, $companies, $companies_id, $details, $action;
    public $suggestions = [];
    public $status = false;

    protected $rules =
    [
        'type' => 'required',
        'start' => 'required|date',
        'end' => 'nullable|date',
        'companies' => 'required',
        'venue' => 'required',
        'details' => 'required'
    ];

    public function updateQuery()
    {
        $toQuery = explode(',', $this->companies);

        if ($this->companies) {
            $this->suggestions = Company::where('name', 'like', '%' .  trim(end($toQuery)) . '%')
                ->limit(5)
                ->get()
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function selectCompany($companyName)
    {
        $toQuery = explode(',', $this->companies);
        array_pop($toQuery);
        $toQuery = implode(',', $toQuery);
        if ($toQuery != null) {
            $this->companies = $toQuery . ", " . $companyName;
        } else {
            $this->companies  = $companyName;
        }
        $this->suggestions = [];
    }

    private function setValues($rowId)
    {
        $this->type = $rowId['type'];
        $this->start = $rowId['start'] ?? '';
        $this->end = $rowId['end'] ?? '';
        $this->companies = $rowId['related_companies'];
        $this->venue = $rowId['venue'];
        $this->details = $rowId['details'];

        $this->activity =  RecruitmentActivity::where('id', '=', $rowId['id'])->first();
        $this->js('new bootstrap.Offcanvas(document.getElementById("offcanvasRecruitment")).toggle();');
    }

    #[On('add')]
    public function addRecruitment()
    {
        $this->refresh();
        $this->dispatch('show-tinyMce');
        $this->dispatch('toggle-offcanvas', id: 'offcanvasRecruitment');
        $this->action = 'saveActivity';
        $this->status = true;
    }

    public function saveActivity()
    {
        $validated =  $this->validate();

        try {
            $activity = new RecruitmentActivity($validated);
            $activity->save();
            $this->getCompanies();
            $activity->companies()->sync($this->companies_id);
            Session::flash("success", "Recruitment activity has been updated successfully.");
            $this->dispatch('RefreshComponent');

            $this->dispatch('toggle-offcanvas', id: 'offcanvasRecruitment');
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }


    #[On('view')]
    public function showRecruitment($rowId): void
    {
        $this->refresh();
        $this->setValues($rowId);
        $this->dispatch('show-tinyMce');
        $this->action = 'updateActivity';
        $this->status = false;
    }


    #[On('edit')]
    public function editRecruitment($rowId): void
    {
        $this->refresh();
        $this->setValues($rowId);
        $this->dispatch('show-tinyMce');
        $this->action = 'updateActivity';
        $this->status = true;
    }


    #[On('delete')]
    public function deleteRecruitment($rowId): void
    {
        $this->refresh();
        $this->setValues($rowId);
        $this->dispatch('show-tinyMce');
        $this->action = 'deleteActivity';
        $this->status = false;
    }

    public function deleteActivity()
    {
        try {
            $this->activity->companies()->detach();
            $this->activity->delete();
            Session::flash("success", "Activity has been deleted successfully.");
            $this->dispatch('RefreshComponent');

            $this->dispatch('toggle-offcanvas', id: 'offcanvasRecruitment');
        } catch (\Exception $exception) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }



    public function updateActivity()
    {
        try {
            $this->getCompanies();
            $this->activity->companies()->sync($this->companies_id);
            $this->activity->type = $this->type;
            $this->activity->start = $this->start;
            $this->activity->end = $this->end;
            $this->activity->details = $this->details;
            $this->activity->save();
            Session::flash("success", "Recruitment activity has been updated successfully.");
            $this->dispatch('RefreshComponent');

            $this->dispatch('toggle-offcanvas', id: 'offcanvasRecruitment');
        } catch (\Exception $exception) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later.");
        }
    }

    private function getCompanies()
    {
        $this->companies_id =   Company::whereIn('name', explode(', ', $this->companies))
            ->get();
        $this->companies_id =   $this->companies_id->pluck('id')->toArray();
    }

    private function refresh()
    {
        $this->reset(['type', 'start', 'end', 'companies', 'details', 'venue']);
    }

    public function render()
    {
        return view('livewire.peso.recruitment.index')->layout('components.layouts.portal', ['header' => 'Recruitment Activities', 'subheader' => 'Displaying all recruitment activities.']);
    }
}
