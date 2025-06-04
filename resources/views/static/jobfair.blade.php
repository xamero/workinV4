@extends('layouts.wired.max-main')

@section('header')
    Job Fair 2023
@endsection

@section('content')
    <div class="container my-5">
        @include('flash::message')

        <div class="row">
            <div class="col-md-5">
                <img src="{{asset('img/header/jobfair.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-md-7">
                <h1 class="mb-3">Local Recruitment Activity</h1>
                <p class="">Calling all individuals passionate about working in the service industry!</p>
                <p>Ready to serve up some smiles and join a dynamic team? Staff Search Asia Service Cooperative is thrilled to invite you to our exclusive
                    recruitment activity for service crew vacancies at Jollibee Bacarra Rd.! </p>
                <p class="mb-0">Recruiting company: Staff Search Asia Service Cooperative</p>
                <p class="mb-0">🗓️ Date: June 29-30, 2023</p>
                <p class="mb-0"> ⏰ Time: 9:00 AM to 4:00 PM</p>
                <p class=""> 📍 Venue: Ilocos Norte MSME Incubation Center, La Tabacalera Compound, Laoag City</p>
                <p>If you're passionate about delivering exceptional customer experiences and thrive in a fast-paced environment, this event is tailor-made for you!</p>
                <p>Qualifications:</p>
                <ul>
                    <li>18 years old and above</li>
                    <li>No visible tattoo</li>
                    <li>Atleast high school/ALS graduate</li>
                    <li>Must be able to work on flexible schedules including evening, weekends and holidays.</li>
                </ul>
                <p>Your benefits:</p>
                <ul>
                    <li>Free meal</li>
                    <li>Free uniform</li>
                    <li>Service incentive leave</li>
                    <li>Accident insurance</li>
                    <li>400/8 hrs</li>
                    <li>Complete mandatory benefits</li>
                </ul>
                <p>Spread the word to friends, family, and anyone you know who would thrive in a customer-focused environment!
                </p>
                <p>Bee ready to bring your A-game and join us for an exciting journey in the world of service crew excellence!
                </p>
                {{--                <p class="fs-5">Register to get updates on your email!</p>--}}
                {{--                <form data-action="{{route('jobfair.register')}}" id="frmRegister">--}}
                {{--                    <div class="row g-3 align-items-center">--}}
                {{--                        <div class="col-auto">--}}
                {{--                            <input type="text" name="email" id="email" class="form-control form-control-lg"--}}
                {{--                                   placeholder="email">--}}
                {{--                        </div>--}}
                {{--                        <div class="col-auto">--}}
                {{--                            <button class="btn btn-primary btn-lg">Register Now!--}}
                {{--                                <span class="spinner-border spinner-border-sm" style="display: none" role="status"--}}
                {{--                                      aria-hidden="true" id="registerSpinner"></span></button>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </form>--}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('document').ready(function () {
            $('#frmRegister').on('submit', function (e) {

                // document.getElementById('registerSpinner')
                //     .style.display = 'none';
                $('#registerSpinner').show();
                e.preventDefault();
                let url = $(this).data('action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'email': $('#email').val()
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#registerSpinner').hide();
                            $('#success-message').text(data.success)
                            $('#SuccessToast').toast('show');
                        } else {
                            $('#registerSpinner').hide();
                            $('#error-message').text(data.error)
                            $('#ErrorToast').toast('show');
                        }
                    },
                    error: function (data) {
                        $('#error-message').text("Ooops, something went wrong. Please try again later.")
                        $('#ErrorToast').toast('show');
                        $('#registerSpinner').hide();

                    }
                });

            });
        })

    </script>
@endsection
