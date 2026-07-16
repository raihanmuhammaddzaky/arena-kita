<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ArenaKita') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">

    <!-- Scripts and Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-body-md text-on-surface antialiased overflow-x-hidden selection:bg-surface-variant selection:text-on-surface">
    <nav class="bg-surface sticky top-0 w-full shadow-sm z-50 border-b border-outline-variant/20 backdrop-blur-md bg-surface/80">
        <div class="flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4 max-w-container-max mx-auto">
            <a href="{{ route('renter.dashboard') }}" class="font-headline-md text-headline-md font-bold text-primary">ArenaKita</a>
            
            <ul class="hidden md:flex gap-gutter items-center">
                <li>
                    <a class="font-label-md text-label-md {{ request()->routeIs('renter.dashboard') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors duration-300' }}" href="{{ route('renter.dashboard') }}">Beranda</a>
                </li>
                <li>
                    <a class="font-label-md text-label-md {{ request()->routeIs('renter.venues.*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors duration-300' }}" href="{{ route('renter.venues.index') }}">Lapangan</a>
                </li>
                <li>
                    <a class="font-label-md text-label-md {{ request()->routeIs('renter.bookings.*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors duration-300' }}" href="{{ route('renter.bookings.index') }}">Riwayat Pemesanan</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="min-h-[85vh] flex-grow w-full relative">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full py-12 bg-surface-container-low border-t border-outline-variant/20 mt-auto z-10 relative">
        <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop py-stack-sm max-w-container-max mx-auto gap-gutter">
            <div class="font-headline-md text-headline-md font-bold text-primary">ArenaKita</div>
            
            <nav class="flex flex-wrap justify-center gap-6">
                <a class="text-on-surface-variant hover:text-primary font-label-md text-label-md transition-colors" href="#">Privacy Policy</a>
                <a class="text-on-surface-variant hover:text-primary font-label-md text-label-md transition-colors" href="#">Terms of Service</a>
                <a class="text-on-surface-variant hover:text-primary font-label-md text-label-md transition-colors" href="#">Contact Us</a>
                <a class="text-on-surface-variant hover:text-primary font-label-md text-label-md transition-colors" href="#">Support</a>
            </nav>
            
            <div class="font-body-md text-sm text-on-surface-variant">
                © {{ date('Y') }} ArenaKita. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
