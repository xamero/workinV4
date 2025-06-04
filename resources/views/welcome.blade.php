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
<div class="min-h-screen">

    <!-- Page Content -->
    <main class="">
        <div class="container-fluid" style="background-image: url('{{asset('image/background.jpg')}}'); background-size: cover; background-position: center; min-height: 100vh;">
            <div class="row ">
                <div class="col-md-7 d-none d-md-block">
                    <div class="row vh-100">
                        <div class="col-md-9 mx-auto text-center d-flex flex-column justify-content-center ">
                            {{-- <img src="{{asset('lam-ang/images/welcome.webp')}}" class="img-fluid mx-auto" alt=""
                                 style="max-width: 35rem"> --}}
                        </div>
                    </div>

                </div>
                <div class="col-md-5 shadow bg-pilipinas" style="min-height: 25rem; ">
                    <div class="row vh-100">
                        <div class="col-md-10 col-xl-7 mx-auto my-auto">
                            <div class="card border-0 w-100 position-relative" >
                                <div class="card-body position-absolute w-100 top-50 start-0 translate-middle-y">
                                    <img src="{{asset('lam-ang/images/workin.webp')}}" alt="" class="img-fluid mx-auto d-block">
                                    <p class="mb-0 text-white text-center">Mattaginayon a pagsapulan, ditoy workIN mo a
                                        masarakan. Start your job search journey!</p>

                                    <a class="btn btn-lg text-white form-control mt-5 border-0 border-bottom rounded-0" href="{{route('register')}}">
                                        Create Account
                                    </a>
                                    <p class="text-center mt-3 text-white">or</p>
                                    <a class="btn btn-lg text-white form-control border-0 border-bottom rounded-0" href="{{route('login')}}">
                                        Login
                                    </a>

                                    <ul class="nav mt-5  justify-content-center small">
                                        <li class="nav-item small">
                                            <a class="nav-link hover-over-blue small" target="_blank" aria-current="page" href="{{route('privacy')}}">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link hover-over-blue small" target="_blank" href="{{route('how')}}">How it works</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link hover-over-blue small" target="_blank" href="{{route('about')}}">About us</a>
                                        </li>
                                    </ul>
                                    <p class="mb-0 text-center text-white-50 mt-3 small">Powered by the Information Technology Office.</p>
                                    <p class="text-white-50 small text-center">Official website of the Provincial Government of Ilocos Norte.  All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

{{--<x-footer/>--}}

<x-toast/>
{{--    @livewireScripts--}}
<script src="https://cdn.tiny.cloud/1/o92mlaxru46re58ozkwz8vhsvkapflo69v16r3125wkftzqe/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

</body>

</html>
