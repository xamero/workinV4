<div>
    <nav class="navbar navbar-expand-lg  bg-primary  py-2 ">
        {{-- Option of container or container fluid --}}
        <div class="container">

            <a class="navbar-brand text-white" href="#"><img src="{{ asset('lam-ang/images/workin.webp') }}"
                    alt="" style="max-width:10rem"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('jobs.search.index') }}">Job Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('company.index') }}">Companies</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            My Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-muted" href="{{ route('applicant.profile') }}">Resume</a>
                            </li>
                            <li><a class="dropdown-item text-muted"
                                    href="{{ route('applicant.application') }}">Applications</a></li>
                            {{--                        <li> --}}
                            {{--                            <hr class="dropdown-divider"> --}}
                            {{--                        </li> --}}
                        </ul>
                    </li>
                </ul>
                <span class="d-flex justify-content-end">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                        alt="{{ Auth::user()->name }}" class="rounded-circle" height="50px"
                                        width="50px" />
                                @else
                                    <span class="inline-flex rounded-md">
                                        <img class="rounded-5" style="max-width: 3.5rem"
                                            src="https://randomuser.me/api/portraits/lego/{{ rand(0, 8) }}.jpg"
                                            alt="{{ Auth::user()->name }}" height="50px" width="50px" />

                                        {{-- <button type="button" class=""> --}}
                                        {{-- {{ Auth::user()->name }} --}}
                                        {{-- </button> --}}
                                    </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <p class="dropdown-item-text">{{ Auth::user()->name }}</p>
                                </li>
                                <li><a class="dropdown-item text-muted">Manage Account</a></li>
                                <li><a class="dropdown-item text-muted" href="{{ route('profile.show') }}">Profile</a>
                                </li>
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <li><a class="dropdown-item text-muted" href="{{ route('api-tokens.index') }}">API
                                            Tokens</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <button class="btn" href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </span>
            </div>
        </div>
    </nav>
    <div class="bg-danger" style="height: 3px">

    </div>
</div>
