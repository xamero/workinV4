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
        <div class="col-lg-8 col-md-10 ">
            <h1>About workIN</h1>
            <p class="display-6">workIN est. 2021</p>
            <p class="">The coronavirus disease (COVID-19) pandemic has become a significant threat to our
                society and has disrupted economic activities globally. However, as we gradually live by the new
                normal
                thru
                maximizing
                the use of the internet, the <b>Provincial Government of Ilocos Norte</b> launched <b>workIN</b> to
                cater
                the needs of jobseekers and employers in the province. It went live in the month of April 2021 under
                the
                guidance of <b>Gov. Matthew J. Marcos Manotoc</b> to answer
                the growing problem of unemployment and job mismatch.
            </p>
            <p class="">workIN is the official job-search portal of the <b>Provincial Government of Ilocos
                    Norte.</b> With the help
                    of technology and workIN, job search and application is now just a few clicks away. Our
                    core mission is to help our kailians get jobs and help employers find great candidates.</p>
            <p class="">Jobseekers can browse through an array of job vacancies posted by accredited and
                government-recognized companies and agencies; and companies can speed up their hiring or recruitment
                process. Through <b>workIN</b>, jobseekers can freely apply for opportunities they qualify for; and
                employers can post their vacancies for jobseekers to apply for.
            </p>
            <p class="">
                Despite the in-person restrictions caused by the
                pandemic, the <b>Provincial Government</b> has benefitted the Ilocano people a platform to
                continuously
                improve the employment services in the province. </p>

            <p class="">WorkIN continues to grow its database of employers and partner agencies and
                continuously
                encourage them to post their job openings on the website to reach our kailians wherever they
                are in the world.
            </p>
            <p class="">The WorkIN team is also in the continuing search for local (public and private) and
                international blue and white collar jobs for our kailians. Moreover, WorkIN also offers free
                trainings and seminars to make our kailians job ready.
            </p>
{{--            <p class="">WorkIN is a collaborative project of the <b>Provincial Public Employment Service--}}
{{--                    Office</b> headed--}}
{{--                by Lizzette Bitancor Atuan, <b>Communication and Media Office</b> headed by Rhona Ysabel Daoang and--}}
{{--                the <b>Information Technology Office</b> headed by Wilfredo Lorenzo Jr.--}}
{{--            </p>--}}
{{--            <p class="">WorkIN is being managed and developed by Erwin Maximo of the Research and--}}
{{--                Development Section--}}
{{--                of the Information Technology Office.--}}
{{--            </p>--}}

            <p class="display-6 mt-5">Provincial Mission</p>
            <p class="fs-5"><i>“SAPASAP A SALUN-AT”</i> (Accessible Healthcare for All)</p>
            <p class="fs-5"><i>“NARIMAT NGA AGLAWLAW”</i> (A Brighter Environment)</p>
            <p class="fs-5"><i>“AGTULTULOY A TULONG PARA MANNALON KEN MANGNGALAP”</i> (Continuing
                Assistance
                to
                Farmers and Fisherfolks)</p>
            <p class="fs-5"><i>“NAURNOS A TRANSPORTASION”</i> (Organized Transportation)</p>
            <p class="fs-5"><i>“ADADU A PAGPUONAN KEN NARUAY A PANGGEDAN”</i> (More Investments and
                Jobs)</p>
            <p class="display-6 mt-5">Provincial Vision:</p>
            <p class="fs-5"><i>“Narimat nga arapaap, intay’ amin maragpat!”</i></p>
            <p class="fs-5 mb-5">(A brighter future, we can all achieve!)</p>
        </div>
    </div>
</body>
