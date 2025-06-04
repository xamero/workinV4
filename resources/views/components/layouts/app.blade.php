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


    {{-- @livewireStyles--}}
</head>

<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @livewire('navigation-menu')

    @if (isset($loader))
        {{$loader}}
    @endif

<!-- Page Heading -->
    @if (isset($header) )
        <header class="d-flex py-3 bg-white shadow-sm border-bottom">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endif

<!-- Page Content -->
    <main class="min-vh-100">
        {{ $slot }}
    </main>
</div>

<x-footer/>

<x-toast/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.slim.min.js"
        integrity="sha512-sNylduh9fqpYUK5OYXWcBleGzbZInWj8yCJAU57r1dpSK9tP2ghf/SRYCMj+KsslFkCOt3TvJrX2AV/Gc3wOqA=="
        crossOrigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('toggle-offcanvas', (event) => {
            const offcanvasElement = document.getElementById(event.id);

            if (offcanvasElement) {
                // console.log('Offcanvas element found:', offcanvasElement);
                const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                // Toggle Offcanvas visibility based on current state
                if (offcanvasElement.classList.contains('show')) {
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
    const screenType = window.innerWidth <= 768 ? 'mobile' : 'desktop';
        document.cookie = "screen_type=" + screenType + "; path=/";
        console.log("Screen type cookie set to: " + screenType);
        // window.location.reload(); // refresh page so Blade can use the cookie
</script>
<script src="https://kit.fontawesome.com/0bb69a1b42.js" crossorigin="anonymous"></script>
</body>

</html>
