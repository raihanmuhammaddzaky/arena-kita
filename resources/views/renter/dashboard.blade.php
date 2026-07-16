@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg kawung-pattern relative">
    
    <!-- Greeting Section -->
    <x-dashboard.welcome-banner :user="$user" :unpaidBooking="$unpaidBooking" />

    <div class="flex flex-col gap-stack-lg">
        
        <!-- SECTION: PAPAN PENGUMUMAN -->
        <x-dashboard.announcements :announcements="$announcements" />

        <!-- SECTION 2: JADWAL LAPANGAN (UPCOMING ATAU RECENT) -->
        <x-dashboard.recent-bookings :upcomingBookings="$upcomingBookings" :recentBookings="$recentBookings" />

        <!-- SECTION 3: KATALOG SINGKAT (FEATURED COURTS) -->
        <x-dashboard.recommended-venues :featuredVenues="$featuredVenues" />

    </div>
</div>
@endsection
