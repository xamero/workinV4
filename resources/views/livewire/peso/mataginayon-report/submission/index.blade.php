<div>
    <div class="container-fluid p-5 bg-white rounded">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                {{-- <button class="btn btn-primary" wire:click="submitReport">Submit Report</button> --}}
            </div>
        </div>
        <div class="row py-3">
            <div class="alert alert-success">
                This is the list of reports that you need to submit. Please make sure to submit the correct report. Please download the report template and fill it up. <a href="{{ asset('mataginayon-a-trabaho-template.xlsx') }}" class="btn btn-secondary btn-sm" download>Download Report Template</a>
            </div>
        </div>
        <div class="row py-3 ">
            <x-form-panel-vertical class="col-md-2">
                <x-label>Year:</x-label>
                <select class="form-control" name="" id="" wire:model.live="yearFilter">
                    <option value=""></option>
                    @foreach ($yearOptions as $option)
                        <option value="{{ $option }}">{{ $option }}
                        </option>
                    @endforeach
                </select>
            </x-form-panel-vertical>
            <p wire:loading wire:target="yearFilter" class="text-secondary" role="status">
                Loading records .....
            </p>
        </div>
        <div class="row py-3">
            <div class="col-md-12 ">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report Title</th>
                            <th>Remarks</th>
                            <th>Due Date</th>
                            <th>Your Report</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->title }}
                                    <p class="small text-muted">
                                        {{ \Carbon\Carbon::parse($report->start_date)->format('M. d, Y') }} -
                                        {{ \Carbon\Carbon::parse($report->end_date)->format('M. d, Y') }}
                                    </p>
                                </td>
                                <td>
                                    <p class="">{{ $report->message }}</p>

                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($report->deadline)->format('M. d, Y') }}
                                    @if ($report->deadline_extension)
                                        <span class="badge bg-warning">Extended</span>
                                        <br>
                                        {{ \Carbon\Carbon::parse($report->deadline_extension)->format('M. d, Y') }}
                                    @endif
                                    @if (
                                        (\Carbon\Carbon::parse($report->deadline)->isPast() &&
                                            \Carbon\Carbon::parse($report->deadline_extension)->isPast()) ||
                                            (\Carbon\Carbon::parse($report->deadline)->isPast() && $report->deadline_extension == null))
                                        <span class="badge bg-danger">Closed</span>
                                    @else
                                        <span class="badge bg-success">Open</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($report->report_status != null && $report->report_file_path != null)
                                        <a href="{{ Storage::url($report->report_file_path) }}" class="text-primary"
                                            download="{{ Str::slug($report->title) }}.pdf" download>Download File</a>
                                        <p class="small text-muted mb-0">Submitted on
                                            {{ \Carbon\Carbon::parse($report->report_submitted_at)->format('M. d, Y') }}
                                        </p>
                                    @else
                                        <span class="badge bg-danger">Not Submitted</span>
                                    @endif

                                    @if ($report->deadline_extension == null)
                                        @if (Carbon\Carbon::parse($report->deadline)->endOfDay() <
                                                Carbon\Carbon::parse($report->report_submitted_at)->endOfDay())
                                            <span class="badge bg-danger">Late submission</span>
                                        @endif
                                    @else
                                        @if (Carbon\Carbon::parse($report->deadline_extension)->endOfDay() <
                                                Carbon\Carbon::parse($report->report_submitted_at)->endOfDay())
                                            <span class="badge bg-danger">Late submission</span>
                                        @endif
                                    @endif
                                </td>

                                <td class="text-center">
                                    <button
                                        class="pointer {{ $report->report_file_path == null ? 'pointer-danger' : 'pointer-success' }}"
                                        wire:click="submitOnSelectedReport({{ $report->id }})" title="Submit">
                                        <span wire:loading.remove
                                            wire:target="submitOnSelectedReport({{ $report->id }})">
                                            <x-awesome.upload></x-awesome.upload>
                                        </span>
                                        <span wire:loading wire:target="submitOnSelectedReport({{ $report->id }})">
                                            <div class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span></button>

                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6">No reports to be submitted.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('livewire.peso.mataginayon-report.submission.offcanvas-submit-report')

</div>
