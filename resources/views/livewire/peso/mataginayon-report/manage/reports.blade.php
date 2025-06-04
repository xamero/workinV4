<div>
    <div class="container-fluid py-5 bg-white">
        <div class="row py-3">
            <x-form-panel-vertical class="col-md-3 col-lg-2">
                <x-label>Year:</x-label>
                <select class="form-control" name="" id="" wire:model.live="yearFilter">
                    <option value=""></option>
                    @foreach ($yearOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </x-form-panel-vertical>
            <x-form-panel-vertical class="col-md-3 col-lg-2">
                <x-label>Title:</x-label>
                <select class="form-control" name="" id="" wire:model.live="titleFilter">
                    <option value=""></option>
                    @foreach ($titleOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </x-form-panel-vertical>
             <x-form-panel-vertical class="col-md-3 col-lg-2">
                <x-label>LGU</x-label>
                <select class="form-control" name="" id="" wire:model.live="companyFilter">
                    <option value=""></option>
                    @foreach ($companyOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </x-form-panel-vertical>
        </div>
        <div class="row py-3">
            <div class="col table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Submitted by</th>
                            <th>Date Submitted</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $report->company->name ?? '' }} </td>
                                <td>{{ \Carbon\Carbon::parse($report->submitted_at)->format('F j, Y') }}
                                   @if ($report->reportDetails->deadline_extension == null)
                                        @if (Carbon\Carbon::parse($report->reportDetails->deadline)->endOfDay() <
                                                Carbon\Carbon::parse($report->reportDetails->report_submitted_at)->endOfDay())
                                            <span class="badge bg-danger">Late submission</span>
                                        @endif
                                    @else
                                        @if (Carbon\Carbon::parse($report->reportDetails->deadline_extension)->endOfDay() <
                                                Carbon\Carbon::parse($report->reportDetails->report_submitted_at)->endOfDay())
                                            <span class="badge bg-danger">Late submission</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ Storage::url($report->file_path) }}" class="text-primary" download="{{ str_replace(' ', '_', $report->company->name ?? 'company') }}_{{ str_replace(' ', '_', $report->reportDetails->title) }}">Download File</a>
                                </td>
                            </tr>
                            @empty
                            <tr >
                                <td colspan="3">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
