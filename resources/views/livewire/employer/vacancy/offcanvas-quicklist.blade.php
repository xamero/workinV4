<div wire:ignore.self class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasQuickList"
     aria-labelledby="offcanvasQuickListLabel">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="offcanvasEditLabel">List of Applicants</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if($vacancy != null)
            <p class="fs-4">{{$vacancy->title}}</p>
        <small>Legend:</small>
            <ul class="list-unstyled small">
                <li><span class="badge bg-success">✓</span> Invited to interview</li>
                <li><span class="badge bg-warning">O</span> Waiting</li>
                <li><span class="badge bg-danger">X</span> Declined</li>
            </ul>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>

                @foreach($vacancy->applicantProfile as $applicant)
                    <tr>
                        <td>{{$applicant->surname}}, {{$applicant->firstname}} </td>
                        <td>{{date( 'M. d, Y', strtotime($applicant->pivot->applied_at))}}</td>
                        <td> @if($applicant->pivot->status == 1)
                                <span class="badge bg-success">✓</span>
                            @elseif($applicant->pivot->status == 2)
                                <span class="badge bg-danger">X</span>
                            @else
                                <span class="badge bg-warning">O</span>
                            @endif</td>
                        <th><a class="btn"><i class="far fa-eye"></i></a></th>
                    </tr>

                @endforeach
            </table>
        @endif
    </div>

</div>
