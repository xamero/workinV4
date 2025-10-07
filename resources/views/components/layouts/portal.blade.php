<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/webp" href="{{ asset('lam-ang/images/workin.webp') }}">
    @stack('meta')
    @stack('styles')
    {{-- @livewireStyles --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap&text=homeassignment_indpersonaccount_circle_off"
        rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" style="z-index:20" class="">
            <div class="card  m-2  bg-white h-100 rounded-4 border-0 shadow-lg">
                <div class="sidebar-header text-center position-relative bg-light shadow-lg rounded-4"
                    style="background-image: url('{{ asset('lam-ang/images/capitol-grey.webp') }}'); height:125px; background-size: 100%; background-position: bottom; background-repeat: no-repeat;">
                    {{-- <img src="{{ asset('lam-ang/images/work.png') }}" alt="" style="max-width:10rem; "> --}}
                    <a type="button" id="sidebarCollapse" class="btn btn-secondary bg-pilipinas"
                        style="position: absolute; right:-25px; top:100px ">
                        <x-awesome.chevron class=""></x-awesome.chevron>
                    </a>
                </div>
                <div class="card-body p-2  rounded-bottom-0 rounded-4">

                    <div class="row">
                        <div class="col text-center">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                    alt="{{ Auth::user()->name }}" class="rounded-circle mx-auto" height="150px"
                                    width="150px" />
                            @else
                                <span class="inline-flex rounded-md">
                                    <img class="rounded-5" style="max-width: 3.5rem"
                                        src="https://randomuser.me/api/portraits/lego/{{ rand(0, 8) }}.jpg"
                                        alt="{{ Auth::user()->name }}" height="150px" width="150px" />

                                    {{-- <button type="button" class=""> --}}
                                    {{-- {{ Auth::user()->name }} --}}
                                    {{-- </button> --}}
                                </span>
                            @endif
                            <p class="mt-3 mb-0">{{ Auth::user()->name }}</p>
                            <p><a class="dropdown-item text-white small" href="{{ route('profile.show') }}">Account
                                    Settings</a>
                            </p>
                        </div>
                    </div>
                    @role('employer')
                        <ul class="list-unstyled accordion accordion-flush mt-3" id="accordionFlush">

                            <li
                                class="{{ Route::currentRouteName() === 'employer.dashboard.index' ? 'highlight bg-pilipinas rounded rounded-3 ' : '' }}">
                                <a href="{{ route('employer.dashboard.index') }}"
                                    class="d-flex gap-2 text-decoration-none">
                                    <span class="material-symbols-outlined">home</span>Home</a>
                            </li>

                            <li>
                                <button class="accordion-button collapsed d-flex gap-2 " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <span class="material-symbols-outlined">
                                        assignment_ind
                                    </span> Job Posting
                                </button>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <ul class="list-unstyled">
                                        <li
                                            class="{{ Route::currentRouteName() === 'employer.vacancy.index' ? 'highlight bg-pilipinas rounded rounded-3 ' : '' }}">
                                            <a wire:navigate href="{{ route('employer.vacancy.index') }}">Active</a>
                                        </li>
                                        <li
                                            class="{{ Route::currentRouteName() === 'employer.vacancy.archive' ? 'highlight bg-pilipinas rounded rounded-3 ' : '' }}">
                                            <a wire:navigate href="{{ route('employer.vacancy.archive') }}">Archive</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li
                                class="{{ Route::currentRouteName() === 'employer.vacancy.applicant' ? 'highlight bg-pilipinas rounded rounded-3 ' : '' }}">
                                <a wire:navigate href="{{ route('employer.vacancy.applicant', [0]) }}"
                                    class="d-flex gap-2 text-decoration-none">
                                    <span class="material-symbols-outlined">
                                        person
                                    </span>Applicants</a>
                            </li>
                        </ul>
                    @endrole
                    @role('peso')
                        <ul class="list-unstyled accordion accordion-flush mt-3" id="accordionFlush">
                            <li class="{{ Route::currentRouteName() === 'peso.dashboard.index' ? 'highlight' : '' }}">
                                <a href="{{ route('peso.dashboard.index') }}"
                                    class=""><x-awesome.dashboard></x-awesome.dashboard> Dashboard</a>
                            </li>
                            <li>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <x-awesome.post></x-awesome.post> Job Posting
                                </button>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse "
                                    data-bs-parent="#accordionFlushExample">
                                    <ul class="list-unstyled">
                                        <li
                                            class="{{ Route::currentRouteName() === 'peso.vacancy.index' ? 'highlight' : '' }}">
                                            <a wire:navigate href="{{ route('peso.vacancy.index') }}">Active</a>
                                        </li>
                                        <li
                                            class="{{ Route::currentRouteName() === 'peso.vacancy.archive' ? 'highlight' : '' }}">
                                            <a wire:navigate href="{{ route('peso.vacancy.archive') }}">Archive</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="{{ Route::currentRouteName() === 'peso.company.index' ? 'highlight' : '' }}">
                                <a wire:navigate href="{{ route('peso.company.index') }}" class="">
                                    <x-awesome.companies></x-awesome.companies> Companies</a>
                            </li>
                            <li class="{{ Route::currentRouteName() === 'peso.recruitment.index' ? 'highlight' : '' }}">
                                <a wire:navigate href="{{ route('peso.recruitment.index') }}"
                                    class=""><x-awesome.calendar></x-awesome.calendar> Recruitment Activity</a>
                            </li>
                            <li>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseMat" aria-expanded="false"
                                    aria-controls="flush-collapseMat">
                                    <x-awesome.folder></x-awesome.folder> MAT Report
                                </button>
                                <div id="flush-collapseMat" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionFlush">
                                    <ul class="list-unstyled">
                                        <li
                                            class="{{ Route::currentRouteName() === 'peso.mataginayon-report.manage' ? 'highlight' : '' }}">
                                            <a wire:navigate
                                                href="{{ route('peso.mataginayon-report.manage') }}">Manage</a>
                                        </li>
                                        <li
                                            class="{{ Route::currentRouteName() === 'peso.mataginayon-report.reports' ? 'highlight' : '' }}">
                                            <a wire:navigate
                                                href="{{ route('peso.mataginayon-report.reports') }}">Reports</a>
                                        </li>
                                        <li
                                            class="{{ Route::currentRouteName() === 'peso.mataginayon-report.submission' ? 'highlight' : '' }}">
                                            <a wire:navigate href="{{ route('peso.mataginayon-report.submission') }}">My
                                                Reports</a>
                                        </li>
                                        {{-- <li class="{{ Route::currentRouteName() === 'peso.vacancy.archive' ? 'highlight' : '' }}">
                                <a wire:navigate href="{{route('peso.vacancy.archive')}}">Submitted Reports</a>
                            </li> --}}
                                    </ul>
                                </div>
                            </li>
                            <li
                                class="{{ Route::currentRouteName() === 'administrator.manage-user-roles' ? 'highlight' : '' }}">
                                <a wire:navigate href="{{ route('administrator.manage-user-roles') }}" class="">
                                    User
                                    Roles</a>
                            </li>
                        </ul>
                    @endrole
                    @role('peso-manager')
                        <ul class="list-unstyled accordion accordion-flush mt-3" id="accordionFlush">
                            <li>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseMat" aria-expanded="false"
                                    aria-controls="flush-collapseMat">
                                    <x-awesome.folder></x-awesome.folder> MAT Report
                                </button>
                                <div id="flush-collapseMat" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionFlush">
                                    <ul class="list-unstyled">
                                        <li
                                            class="{{ Route::currentRouteName() === 'peso.mataginayon-report.submission' ? 'highlight' : '' }}">
                                            <a wire:navigate href="{{ route('peso.mataginayon-report.submission') }}">My
                                                Reports</a>

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @endrole
                    {{-- <ul class="list-unstyled w-100">
                        <li> --}}
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button class="btn d-flex gap-2" style="position:absolute; bottom: 15px"
                            href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            <span class="material-symbols-outlined">
                                account_circle_off
                            </span>
                            Log-out
                        </button>
                    </form>
                    {{-- </li>
                    </ul> --}}
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            {{-- <div class="row">
                <div class="col text-end">
                    <a class="btn btn-light" href="#">
                        <i class="fas fa-bell text-dark"></i>
                    </a>
                </div>
            </div> --}}
            <div class="row bg-white shadow rounded-end-4">
                <div class="col-md-12 ps-5">
                    @if (isset($header))
                        <header class="p-3 ">
                            <h2 class="text-primary">{{ $header }}</h2>
                            @if (isset($subheader))
                                <p class="text-muted">{{ $subheader }}</p>
                            @endif
                        </header>
                    @endif
                </div>
            </div>
            <div class="ps-5 py-5">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.slim.min.js"
        integrity="sha512-sNylduh9fqpYUK5OYXWcBleGzbZInWj8yCJAU57r1dpSK9tP2ghf/SRYCMj+KsslFkCOt3TvJrX2AV/Gc3wOqA=="
        crossOrigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
                $(".rotate").toggleClass("side");
            });

            // Check if an accordion section was previously opened
            var activeSection = localStorage.getItem('activeAccordionSection');

            if (activeSection) {
                // Open the previously active section
                $(activeSection).addClass('show');
            }

            // Save the active accordion section to local storage when a section is shown
            $('#accordionFlush').on('show.bs.collapse', function(e) {
                localStorage.setItem('activeAccordionSection', '#' + e.target.id);
            });

            const screenType = window.innerWidth <= 768 ? 'mobile' : 'desktop';
            document.cookie = "screen_type=" + screenType + "; path=/";
            console.log("Screen type cookie set to: " + screenType);

        });
        document.addEventListener('livewire:init', () => {
            Livewire.on('toggle-offcanvas', (event) => {
                const offcanvasElement = document.getElementById(event.id);
                if (offcanvasElement) {
                    console.log('Offcanvas element found:', offcanvasElement);
                    const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    // Toggle Offcanvas visibility based on current state
                    if (offcanvasElement.classList.contains('show')) {
                        console.log('hey');
                        // offcanvas.hide();
                        offcanvasElement.classList.remove('show');
                    } else {
                        offcanvas.show();
                    }
                } else {
                    console.log('Offcanvas element not found');
                }
            });
        });
    </script>

    <!-- Styles -->
    <script src="https://kit.fontawesome.com/0bb69a1b42.js" crossorigin="anonymous"></script>

</body>

</html>
