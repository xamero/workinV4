<?php

namespace App\Livewire\Peso\MataginayonReport\Submission;

use Livewire\Component;
use App\Models\MatReport;
use App\Models\MatReportDetails;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithFileUploads;

    public $action, $status;

    public $company_id,  $file_path, $file_preview;

    public $reports, $activeReport, $file_upload;
    public $report_status, $report_details, $isLate;

    //filters
    public $yearOptions, $statusOptions;
    public $statusFilter, $yearFilter;

    protected $rules = [
        'file_upload' => 'required|mimes:xlsx,xls',
        'report_details' => 'required',
    ];

    public function submitReport()
    {
        $this->dispatch('toggle-offcanvas', id: 'offcanvasSubmitReport');
    }

    public function submitOnSelectedReport($report_id)
    {
        $this->activeReport = MatReportDetails::find($report_id);
        $this->report_details = $this->activeReport->id;
        if (Carbon::parse($this->activeReport->deadline)->isPast() && Carbon::parse($this->activeReport->deadline_extension)->isPast()) {
            $this->isLate = true;
        } else if (Carbon::parse($this->activeReport->deadline)->isPast() && $this->activeReport == null) {
            $this->isLate = true;
        } else {
            $this->isLate = false;
        }

        $this->dispatch('toggle-offcanvas', id: 'offcanvasSubmitReport');
        $this->action = 'saveReport';
        $this->status = true;
    }
    
    public function saveReport()
    {

        $validated = $this->validate();

        try {
            $validated['company_id'] = $this->company_id;
            $validated['submitted_at'] = now();
            $validated['status'] = 'submitted';
            $validated['mat_report_detail_id'] = $this->report_details;

            $checkReport = MatReport::where('mat_report_detail_id', $this->report_details)
                ->where('company_id', $this->company_id)
                ->first();

            if ($this->file_upload) {
                if ($checkReport && $checkReport->file_path) {
                    \Storage::disk('public')->delete($checkReport->file_path);
                }
        
                $fileName = $this->file_upload->store('mataginayon_reports', 'public');
                $validated['file_path'] = $fileName;
            } else {
                Session::flash("error", "File upload is required.");
                return;
            }


            if ($checkReport) {
                $checkReport->update($validated);
                Session::flash("success", "Report was updated successfully.");
            } else {
                MatReport::create($validated);
                Session::flash("success", "Report was saved successfully.");
            }

            // $this->yearFilter = Carbon::parse($this->activeReport->start_date)->year;
        } catch (\Exception $e) {
            Session::flash("error", "There was an error saving the report: " . $e->getMessage());
        }
        $this->dispatch('toggle-offcanvas', id: 'offcanvasSubmitReport');
        // Only reset specific properties instead of everything
        $this->reset(['file_upload', 'report_details', 'action', 'status', 'file_path']);
    }

    public function mount()
    {
        $this->company_id = Auth::user()->employer_profile->company_id ?? null;

        $this->statusOptions = [
            'submitted' => 'Submitted',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'disapproved' => 'Disapproved',
        ];

        $this->statusFilter = $this->statusFilter ?? 'submitted'; // Preserve filter
        $this->yearFilter = $this->yearFilter ?? now()->year; // Preserve filter

        $this->yearOptions = MatReportDetails::selectRaw('YEAR(start_date) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year', 'year');
    }



    public function render()
    {
        $companyId = $this->company_id; // Capture company ID safely
        $this->reports = MatReportDetails::select(
            'mat_report_details.*',
            'mat_reports.id as report_id',
            'mat_reports.status as report_status',
            'mat_reports.file_path as report_file_path',
            'mat_reports.submitted_at as report_submitted_at'
        )
            ->when($this->yearFilter, function ($query) {
                $query->whereYear('start_date', $this->yearFilter);
            })
            ->leftJoin('mat_reports', function ($join) use ($companyId) {
                $join->on('mat_report_details.id', '=', 'mat_reports.mat_report_detail_id')
                    ->where(function ($query) use ($companyId) {
                        $query->whereNull('mat_reports.company_id')
                            ->orWhere('mat_reports.company_id', $companyId);
                    });
            })
            ->orderBy('start_date', 'desc')
            ->get();

        return view('livewire.peso.mataginayon-report.submission.index')
            ->layout('components.layouts.portal', [
                'header' => 'Mataginayon a Trabaho',
                'subheader' => 'Submit your reports in fulfillment of the requirements of Provincial Ordinance No. 080-2024'
            ]);
    }
}
