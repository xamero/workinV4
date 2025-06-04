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
                <button class="btn btn-primary" wire:click="createReport">Open Submission</button>
                @include('livewire.peso.mataginayon-report.manage.offcanvas-report')
            </div>
        </div>
        <div class="row">
            <div class="col md-12 my-5">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report Title</th>
                            <th>Type</th>
                            <th>Inclusive Date</th>
                            <th>Due Date</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$report->title}}</td> 
                            <td>{{$report->report_type}}</td>   
                            <td>{{ \Carbon\Carbon::parse($report->start_date)->format('M. d, Y') }} - {{ \Carbon\Carbon::parse($report->end_date)->format('M. d, Y') }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($report->deadline)->format('M. d, Y') }}
                                @if ($report->deadline_extension)
                                    <span class="badge bg-warning">Extended</span>
                                    <br>
                                    {{ \Carbon\Carbon::parse($report->deadline_extension)->format('M. d, Y') }}
                                @endif
                                @if (\Carbon\Carbon::parse($report->end_date)->isPast())
                                    <span class="badge bg-danger">Closed</span>
                                @else
                                    <span class="badge bg-success">Open</span>
                                @endif
                            </td>
                            <td>{{ $report->message }}</td>
                            <td>
                                <button class="pointer pointer-primary" wire:click="editReport({{ $report }})" title="Edit"><x-awesome.edit></x-awesome.edit></button>
                                <button class="pointer pointer-danger" wire:click="promptDeleteReport({{ $report->id}})" title="Delete"><x-awesome.trash></x-awesome.trash></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>