<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="g-light font-sans antialiased">
        {{ $slot }}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.slim.min.js"
            integrity="sha512-sNylduh9fqpYUK5OYXWcBleGzbZInWj8yCJAU57r1dpSK9tP2ghf/SRYCMj+KsslFkCOt3TvJrX2AV/Gc3wOqA=="
            crossOrigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toggle-offcanvas', (event) => {

                const offcanvasElement = document.getElementById(event.id);
                console.log('hey');
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

</body>

</html>
