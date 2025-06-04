<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cabin&family=Tinos&display=swap"
          rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <script src="https://kit.fontawesome.com/0bb69a1b42.js" crossorigin="anonymous"></script>

    {{--    @livewireStyles--}}
</head>

<body class="font-sans antialiased">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 col-lg-8">
            <h1 class="mb-4">How workIN works</h1>
            <p class="">The coronavirus disease (COVID-19) pandemic has become a significant threat to our
                society
                and
                has disrupted economic activities globally. However, as we gradually live by the new normal thru
                maximizing
                the use of the internet, the <b>Provincial Government of Ilocos Norte</b> launched <b>workIN</b> to
                cater the needs of jobseekers and
                employers in the province.
            </p>
            <p class="">Jobseekers can browse through an array of job vacancies posted by accredited and
                government-recognized companies and agencies; and companies can speed up their hiring or recruitment
                process. Through <b>workIN</b>, jobseekers can freely apply for opportunities they qualify for; and
                employers
                can post their vacancies for jobseekers to apply for.
            </p>
            <p class="fs-5">
                Despite the in-person restrictions caused by the
                pandemic, the <b>Provincial Government</b> has benefitted the Ilocano people a platform to
                continuously
                improve the
                employment services in the province. </p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8 col-lg-6">
            <h4 class="">How it Work for Job Seekers</h4>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-2 d-flex justify-content-md-end">
            <h1 class="circle-icon circle-icon-danger text-danger">1</h1>
        </div>
        <div class="col-md-8 col-lg-6"><h2>Create</h2>
            <p class=""><a href="{{route('register')}}" class="text-decoration-none">Register</a> for a free
                account. <a
                    href="{{route('login')}}" class="text-decoration-none">Login</a> and fill-up your public profile.
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-2 d-flex justify-content-md-end"><h1 class="circle-icon circle-icon-danger text-danger">
                2</h1></div>
        <div class="col-md-8 col-lg-6"><h2>Search</h2>
            <p class="">With our large database of job vacancies, you'll surely find something that fits
                your
                qualification and interest.</p></div>
    </div>
    <div class="row my-2">
        <div class="col-md-2 d-flex justify-content-md-end"><h1 class="circle-icon circle-icon-danger text-danger">
                3</h1></div>
        <div class="col-md-8 col-lg-6"><h2>Apply</h2>
            <p class="">Complete you resume and send it to your prospective employers.</p></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8 col-lg-6">
            <h4 class="">How it Work for Employers</h4>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-2 d-flex justify-content-md-end">
            <h1 class="circle-icon circle-icon-primary text-primary">1</h1>
        </div>
        <div class="col-md-8 col-lg-6"><h2>Create</h2>
            <p class=""><a href="{{route('register')}}" class="text-decoration-none">Register</a> for a free
                account. Upgrade your
                account to
                an
                employer role and complete your company profile.</p></div>
    </div>
    <div class="row  my-3">
        <div class="col-md-2 d-flex justify-content-md-end"><h1 class="circle-icon circle-icon-primary text-primary">
                2</h1></div>
        <div class="col-md-8 col-lg-6"><h2>Post</h2>
            <p class="">Add your job vacancies in our database.</p>
        </div>
    </div>
    <div class="row  my-3">
        <div class="col-md-2 d-flex justify-content-md-end"><h1 class="circle-icon circle-icon-primary text-primary">
                3</h1></div>
        <div class="col-md-8 col-lg-6"><h2>Hire</h2>
            <p class="">Browse through applicants' profile. Invite them for interview then hire.</p></div>
    </div>
</div>
</body>
