<?php

namespace App\Livewire\Peso\MataginayonReport\Manage;

use Livewire\Component;
use App\Models\MatReport;
use App\Models\MatReportDetails;
use Livewire\WithEvents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Index extends Component
{

    public $action, $status;

    public $reports, $activeReport;
    public $report_type = 'quarterly';
    public $start_date, $end_date, $message, $deadline, $deadline_extension, $title;


    public $rules = [
        'report_type' => 'required|in:quarterly,semiannual,annual,weekly,monthly',
        'start_date' => 'required|date|before_or_equal:end_date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'message' => 'string|nullable',
        'deadline' => 'required|date',
        'deadline_extension' => 'nullable|date',
        'title' => 'string|required',
    ];

    public function createReport()
    {
        $this->dispatch('toggle-offcanvas', id: 'offcanvasCreateReport');
        $this->status = true;
        $this->action = 'saveReport';
    }

    public function saveReport()
    {
        $validated = $this->validate();

        try {
            $validated['submitted_at'] = now();
            $validated['report_type'] = $this->report_type; 
             MatReportDetails::create($validated);
    
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCreateReport');
            $this->resetFields();
            // $this->emit('refreshParent');
            Session::flash("success", "Submission was saved successfully.");
            $this->mount();
        } catch (\Exception $e) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later");
        }
    }

    public function editReport(MatReportDetails $report): void
    {
        $this->populateFields($report);
        $this->dispatch('toggle-offcanvas', id: 'offcanvasCreateReport');
        $this->status = true;
        $this->activeReport = $report;
        $this->action = 'updateReport';
    }

    public function updateReport()  
    {
        $validated = $this->validate();

        try {
            $this->activeReport->update($validated);
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCreateReport');
            $this->resetFields();
            // $this->emit('refreshParent');
            Session::flash("success", "Submission was updated successfully.");
            $this->mount();
        } catch (\Exception $e) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later");
        }
    }

    public function promptDeleteReport(MatReportDetails $report)
    {
        $this->activeReport = $report;
        $this->populateFields($report);
        $this->status = false;
        $this->action = 'deleteReport';
        $this->dispatch('toggle-offcanvas', id: 'offcanvasCreateReport');
    }

    public function deleteReport()
    {
        try {
            $this->activeReport->delete();
            Session::flash("success", "Submission was deleted successfully.");
            $this->mount();
            $this->dispatch('toggle-offcanvas', id: 'offcanvasCreateReport');
        } catch (\Exception $e) {
            Session::flash("error", "Ooops, something unexpected happened. Please try again later");
        }
    }

    private function populateFields($report)
    {
        $this->report_type = $report->report_type;
        $this->start_date = $report->start_date;
        $this->end_date = $report->end_date;
        $this->message = $report->message;
        $this->deadline = $report->deadline;
        $this->deadline_extension = $report->deadline_extension;
        $this->title = $report->title;
    }

    private function resetFields()
    {
        $this->report_type = 'quarterly';
        $this->start_date = null;
        $this->end_date = null;
        $this->message = null;
        $this->deadline = null;
        $this->deadline_extension = null;
    }

    public function mount()
    {
        // $this->reports = MatReportDetails::whereYear('start_date', now()->year)
        //     ->orderBy('start_date', 'desc')
        //     ->get();
        $this->reports = MatReportDetails::
            orderBy('start_date', 'desc')    
            ->get();
    }

    public function render()
    {
        return view('livewire.peso.mataginayon-report.manage.index')
            ->layout('components.layouts.portal', [
                'header' => 'Mataginayon a Trabaho',
                'subheader' => 'Manage submitted reports in fulfillment of the requirements of Provincial Ordinance No. 080-2024'
            ]);
    }
}
