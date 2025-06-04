<div>
    <div id="printit container">
        <div class="row">
            <div class="col-md-6">
                <h4>{{ $applicant->firstname}} {{$applicant->midname}} {{$applicant->surname}}</h4>
                {{--                                    <h5>{{$applicant->jobs[0]->title}}</h5>--}}
                <p class="mb-0"><i class="fas fa-mobile-alt"></i> {{$applicant->contactno}}</p>
                <p class="mb-0"><i class="far fa-envelope"></i> {{$applicant->user->email}}</p>
                {{--                                    <p class=""><i class="fas fa-map-marker-alt"></i> {{$applicant->brgy->name}}--}}
                {{--                                        , {{$applicant->city->name}}--}}
                {{--                                        , Ilocos Norte </p>--}}
            </div>
            <div class="col-md-4 text-center">
                @if($applicant->profile_picture_path != null)
                    <img class="card-img-top img text-center " style="max-width: 200px"
                         src="{{asset($applicant->profile_picture_path . '.jpg' )}}"
                         alt=" {{ $$applicant->firstname}} {{$applicant->midname}} {{$applicant->surname}}">
                @endif
            </div>
        </div>
        @if($applicant->introduction != null)
            <div class="mt-4">
                <p class="">{{$applicant->introduction}}</p>
            </div>
        @endif

        @if($applicant->experience->count() > 0)

            <div class="row py-2">
                <div class="col-md-12">
                    <h5 class="text-primary">Work Experience</h5>
                    @forelse($applicant->experience as $exp)
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p class="mb-0">{{$exp->date_started->format('M. d, Y')}} @if( !empty($exp->date_end) )
                                        to {{$exp->date_ended}} @else to
                                        present @endif</p>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-0">{{$exp->position}}</h5>
                                <p class="mb-0">{{$exp->company}}</p>
                                <p class="mb-0 text-muted">{{$exp->address}}</p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        @endif

        @if($applicant->education->count() > 0)
            <div class="row py-2">
                <div class="col-md-12">
                    <h5 class="text-primary"> Educational Background </h5>
                    @foreach($applicant->education as $educ)
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p class="mb-0">{{$educ->years}}</p>
                            </div>
                            <div class="col-md-8">

                                <h5 class="mb-0">{{$educ->course}}</h5>
                                <p class="mb-0">{{$educ->school}} </p>
                                <p class="mb-0">
                                    @if($educ->level == 1)
                                        Elementary
                                    @elseif($educ->level == 2)
                                        Highschool
                                    @elseif($educ->level == 3)
                                        Tech. Voc.
                                    @elseif($educ->level == 4)
                                        College
                                    @else
                                        Post Graduate
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($applicant->training->count() > 0)
            <div class="row py-2">
                <div class="col-md-12">
                    <h5 class="text-primary">Trainings</h5>
                    @forelse($applicant->training as $training)
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p class="">{{$training->date_start->format('M. d, Y')}}
                                    to {{$training->date_end->format('M. d, Y')}}</p>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-0">{{$training->training}}</h5>
                                <p class="mb-0">{{$training->institution}}</p>
                                <p class="mb-0">{{$training->certificate}}</p>
                            </div>
                        </div>
                    @empty
                        No Training/Vocational Course record found.
                    @endforelse
                </div>
            </div>
        @endif

        @if($applicant->eligibility->count() > 0)
            <div class="row py-2">
                <div class="col-md-12">
                    <h5 class="text-primary">Eligibility/License</h5>
                    @forelse($applicant->eligibility as $eligibility)
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p class="mb-0">@if($eligibility->date_exam != null){{$eligibility->date_exam->format('M. d, Y')}}@endif</p>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-0">{{$eligibility->eligibility}}</h5>
                                <p class="mb-0"><span
                                        class="">Rating: </span>{{$eligibility->rating}}%</p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        @endif
        <h5 class="text-primary">Personal Information</h5>
        <div class="row pl-4">
            <div class="col-md-12">
                <p class="mb-0"><span
                        class=" text-muted">Permanent Address: </span> {{$applicant->barangay->name ?? ''}}
                    , {{$applicant->city->name}}, Ilocos Norte
                </p>
                <p class="mb-0"><span
                        class="text-muted">Current Address: </span>{{$applicant->r_addrs_brgy}}
                    , {{$applicant->r_addrs_city}}
                    , {{$applicant->r_addrs_prov}}</p>
                <p class="mb-0"><span
                        class="text-muted">Birthday: </span>{{ \Carbon\Carbon::parse($applicant->birthday)->format('M. d, Y')}}
                </p>
                <p class="mb-0"><span
                        class="text-muted">Birthplace: </span>{{$applicant->place_of_birth}}
                </p>
                <p class="mb-0"><span class="text-muted">Sex: </span>@if($applicant->sex == 0)
                        Female @elseif($applicant->sex == 1)
                        Male @else
                        Unspecified @endif</p>
                <p class="mb-0"><span
                        class="text-muted">Religion: </span>{{$applicant->religion}}</p>
                <p class="mb-0"><span class="text-muted">Civil Status:</span>
                    @if($applicant->civil_status == 1)
                        Single
                    @elseif($applicant->civil_status == 2)
                        Married
                    @elseif($applicant->civil_status == 3)
                        Widowed
                    @elseif($applicant->civil_status == 4)
                        Separated
                    @elseif($applicant->civil_status == 5)
                        Live-in
                    @else
                        Unspecified
                    @endif</p>
                <p class="mb-0"><span
                        class="text-muted">Disability: </span>{{$applicant->disability}}
                </p>
                <p class="mb-0"><span
                        class="text-muted">Employment Status: </span>{{$applicant->employment_status}}
                </p>
            </div>
        </div>
    </div>
</div>
