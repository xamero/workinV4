<?php

namespace App\Livewire\Peso\MataginayonReport\Manage;

use App\Models\MatReport;
use App\Models\MatReportDetails;
use Livewire\Component;

class Reports extends Component
{
    public $reports;

    public $yearOptions,  $titleOptions, $companyOptions;
    public $yearFilter,  $titleFilter, $companyFilter;

    public function mount()
    {
        $this->yearFilter = now()->year;

        $this->yearOptions = MatReportDetails::selectRaw('YEAR(start_date) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year', 'year');
    }

    public function render()
    {
        $this->companyOptions = MatReport::leftJoin('mat_report_details', 'mat_reports.mat_report_detail_id', '=', 'mat_report_details.id')
            ->leftJoin('companies', 'mat_reports.company_id', '=', 'companies.id')
            ->select('companies.name')
            ->when($this->yearFilter, function ($query) {
            $query->whereYear('mat_report_details.start_date', $this->yearFilter);
            })
            ->when($this->titleFilter, function ($query) {
            $query->where('mat_report_details.title', $this->titleFilter);
            })
            ->groupBy('companies.name')
            ->orderBy('companies.name')
            ->get()
            ->pluck('name', 'name');

        $this->titleOptions = MatReportDetails::select('title')
            ->when($this->yearFilter, function ($query) {
                $query->whereYear('start_date', $this->yearFilter);
            })
            ->orderBy('title')
            ->get()
            ->pluck('title', 'title');

        $this->reports = MatReport::leftJoin('mat_report_details', 'mat_reports.mat_report_detail_id', '=', 'mat_report_details.id')
            ->when($this->yearFilter, function ($query) {
                $query->whereYear('mat_report_details.start_date', $this->yearFilter);
            })
            ->when($this->titleFilter, function ($query) {
                $query->where('mat_report_details.title', $this->titleFilter);
            })
            ->with(['company', 'reportDetails'])
            ->get();

        return view('livewire.peso.mataginayon-report.manage.reports')->layout('components.layouts.portal', [
            'header' => 'Mataginayon a Trabaho',
            'subheader' => 'Manage submitted reports in fulfillment of the requirements of Provincial Ordinance No. 080-2024'
        ]);;
    }
}
