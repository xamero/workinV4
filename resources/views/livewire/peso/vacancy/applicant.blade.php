<div>
    <div class="container-fluid">
        <div class="row my-5 bg-white p-5 vh-100 table-responsive rounded  border ">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{$vacancy->title ??  'Displaying all applicants'  }}</h3>
                    </div>
                    <div class="col-md-6">
                        <small>Legend:</small>
                        <ul class="list-unstyled small">
                            <li><span class="badge bg-success">✓</span> Invited to interview</li>
                            <li><span class="badge bg-warning">O</span> Waiting</li>
                            <li><span class="badge bg-danger">X</span> Declined</li>
                        </ul>
                    </div>
                </div>
                <livewire:views.applicants.applicants-by-vacancy-table :vacancy_id="$vacancy_id"/>

            </div>
        </div>
    </div>
</div>
