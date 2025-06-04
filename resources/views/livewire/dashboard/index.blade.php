<div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 col-lg-8">
                <h2>Welcome to your dashboard!</h2>
                <p> Welcome to workIN, your ultimate destination for all your career aspirations! We are thrilled to
                    have you join our dynamic job portal, where we connect talented individuals like you with exciting
                    employment opportunities.
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container py-5">
            <p class="fs-3 mb-5">Calendar of Activities</p>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($activities as $event)
                    <div class="card bg-white border-0 rounded-top rounded-5" >
                        <div class="card-header text-center  rounded-top rounded-5 py-3
                       bg-pilipinas text-white">
                            <h3 class="text-center">{{$event->type}}</h3>
                        </div>
                        <div class="card-body" style="max-height: 20rem; overflow: auto;">
                            <div class="py-3">
                                <p class="text-muted"> {{$event->related_companies}}</p>
                                <p class="text-muted  mb-0">
                                    From: {{\Carbon\Carbon::parse($event->start)->format('M. d, Y h:i A') }}</p>
                                @if($event->end)
                                    <p class="text-muted mb-0">
                                        To: {{\Carbon\Carbon::parse($event->end)->format('M. d, Y h:i A') ?? '' }}</p>
                                @endif
                                <p class="mb-0 text-muted">Venue: {{$event->venue ?? ''}}</p>
                            </div>
                        </div>
                        <div class="card-footer   rounded-bottom rounded-5 bg-light text-center py-3">
                            <a href="" class="text-primary ">More Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white py-5">
        <div class="container bg-pilipinas rounded p-5">
            <p class="lead mb-0 text-white">Trainings and more</p>
            <p class="text-white">Be prepared and equipped, join and enroll in our training programs.</p>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="{{asset('lam-ang/images/dashboard/jobstart.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Job Start Philippines Program</h5>
                            {{--                            <p> JobStart Philippines is a program of the Department of Labor and Employment (DOLE)--}}
                            {{--                                preparing young Filipinos for employment. JobStart does this by providing youth with--}}
                            {{--                                career coaching, life skills and technical trainings, and internships with employers.--}}
                            {{--                            </p>--}}
                            {{--                            <p>--}}
                            {{--                                Partnering with the private sector, JobStart helps employers meet their manpower needs--}}
                            {{--                                with well-prepared, talented, and enthusiastic young men and women. The LGU-based Public--}}
                            {{--                                Employment Service Office (PESO) implements the program.--}}
                            {{--                            </p>--}}
                            <a href="">Read more...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
