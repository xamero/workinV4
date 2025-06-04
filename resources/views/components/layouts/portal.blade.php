<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" style="z-index:20">
            <div class="sidebar-header position-relative">
                <img src="{{ asset('lam-ang/images/workin.webp') }}" alt="" style="max-width:10rem">
                <a type="button" id="sidebarCollapse" class="btn btn-secondary"
                    style="position: absolute; right:-25px; top:25px ">
                    <x-awesome.chevron class=""></x-awesome.chevron>
                </a>

            </div>
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
                    <p><a class="dropdown-item text-white small" href="{{ route('profile.show') }}">Account Settings</a>
                    </p>
                </div>
            </div>
            @role('employer')
                <ul class="list-unstyled accordion accordion-flush mt-3" id="accordionFlush">
                    <li class="{{ Route::currentRouteName() === 'employer.dashboard.index' ? 'highlight' : '' }}">
                        <a href="{{ route('employer.dashboard.index') }}" class="">Dashboard</a>
                    </li>
                    <li>
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Job Posting
                        </button>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <ul class="list-unstyled">
                                <li
                                    class="{{ Route::currentRouteName() === 'employer.vacancy.index' ? 'highlight' : '' }}">
                                    <a wire:navigate href="{{ route('employer.vacancy.index') }}">Active</a>
                                </li>
                                <li
                                    class="{{ Route::currentRouteName() === 'employer.vacancy.archive' ? 'highlight' : '' }}">
                                    <a wire:navigate href="{{ route('employer.vacancy.archive') }}">Archive</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'employer.vacancy.applicant' ? 'highlight' : '' }}">
                        <a wire:navigate href="{{ route('employer.vacancy.applicant', [0]) }}">Applicants</a>
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
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <x-awesome.post></x-awesome.post> Job Posting
                        </button>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse "
                            data-bs-parent="#accordionFlushExample">
                            <ul class="list-unstyled">
                                <li class="{{ Route::currentRouteName() === 'peso.vacancy.index' ? 'highlight' : '' }}">
                                    <a wire:navigate href="{{ route('peso.vacancy.index') }}">Active</a>
                                </li>
                                <li class="{{ Route::currentRouteName() === 'peso.vacancy.archive' ? 'highlight' : '' }}">
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
                            data-bs-target="#flush-collapseMat" aria-expanded="false" aria-controls="flush-collapseMat">
                            <x-awesome.folder></x-awesome.folder> MAT Report
                        </button>
                        <div id="flush-collapseMat" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionFlush">
                            <ul class="list-unstyled">
                                <li
                                    class="{{ Route::currentRouteName() === 'peso.mataginayon-report.manage' ? 'highlight' : '' }}">
                                    <a wire:navigate href="{{ route('peso.mataginayon-report.manage') }}">Manage</a>
                                </li>
                                <li
                                    class="{{ Route::currentRouteName() === 'peso.mataginayon-report.reports' ? 'highlight' : '' }}">
                                    <a wire:navigate href="{{ route('peso.mataginayon-report.reports') }}">Reports</a>
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
                    <li class="{{ Route::currentRouteName() === 'administrator.manage-user-roles' ? 'highlight' : '' }}">
                        <a wire:navigate href="{{ route('administrator.manage-user-roles') }}" class=""> User
                            Roles</a>
                    </li>
                </ul>
            @endrole

            @role('peso-manager')
                <ul class="list-unstyled accordion accordion-flush mt-3" id="accordionFlush">
                    <li>
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseMat" aria-expanded="false" aria-controls="flush-collapseMat">
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


            <ul class="list-unstyled w-100" style="position:absolute; bottom: 0">
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button class="btn text-white form-control d-flex justify-content-between"
                            href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            <span>
                                Log-out
                            </span>
                            <span>
                                <svg class="awesome-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#ffffff"
                                        d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <div class="row">
                <div class="col text-end">
                    <a class="btn btn-light" href="#">
                        <i class="fas fa-bell text-dark"></i>
                    </a>
                </div>
            </div>
            <div class="row">
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
            {{ $slot }}
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
