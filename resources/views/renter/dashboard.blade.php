@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg kawung-pattern relative">
    
    <!-- Greeting Section -->
    <header class="mb-stack-lg">
        <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Welcome back, {{ $user->name }}</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant">Ready for your next match? Here's an overview of your activities.</p>
    </header>

    <div class="flex flex-col gap-stack-lg">
        
        <!-- SECTION 1: SLOT MENUNGGU PEMBAYARAN -->
        @if($unpaidBooking)
        <section>
            <div class="bg-surface-container-lowest border border-[#f59e0b]/40 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow gap-6 w-full">
                <!-- Decorative left border for ticket styling -->
                <div class="absolute inset-y-0 left-0 w-2 bg-[#f59e0b]"></div>
                
                <div class="flex items-start md:items-center gap-5 ml-2">
                    <div class="w-14 h-14 rounded-full bg-[#f59e0b]/10 flex items-center justify-center text-[#b45309] shrink-0 shadow-sm border border-[#f59e0b]/20">
                        <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="bg-[#f59e0b] text-on-primary font-label-md text-[11px] px-2 py-0.5 rounded uppercase tracking-widest">Aksi Diperlukan</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary text-[20px] mb-1">Menunggu Pembayaran</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl">Pemesanan lapangan <span class="font-bold text-on-surface">"{{ $unpaidBooking->venue_name }}"</span> butuh pembayaran sebelum jam <span class="font-bold text-[#b45309]">{{ $unpaidBooking->deadline }}</span> hari ini agar tidak otomatis dibatalkan.</p>
                    </div>
                </div>
                
                <a href="{{ route('renter.bookings.show', $unpaidBooking->id) }}" class="font-label-md text-label-md bg-[#f59e0b] hover:bg-[#d97706] text-on-primary px-6 py-3 rounded-xl transition-colors text-center shrink-0 shadow-sm whitespace-nowrap">
                    Bayar Sekarang
                </a>
            </div>
        </section>
        @endif

        <!-- SECTION: PAPAN PENGUMUMAN -->
        @if(!empty($announcements))
        <section>
            <div class="bg-surface-container-low border border-outline-variant/30 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-on-tertiary-fixed-variant" style="font-variation-settings: 'FILL' 1;">campaign</span>
                    <h2 class="font-headline-md text-primary text-[20px]">Papan Pengumuman</h2>
                </div>
                <div class="flex flex-col gap-3">
                    @foreach($announcements as $announcement)
                    <div class="bg-surface-container-lowest p-4 rounded-xl border border-outline-variant/20 flex gap-4 items-start">
                        <div class="w-2 h-2 mt-2 rounded-full bg-on-tertiary-fixed-variant shrink-0"></div>
                        <div>
                            <p class="font-body-md text-on-surface font-bold mb-1">{{ $announcement->title }}</p>
                            <p class="font-body-md text-on-surface-variant">{{ $announcement->content }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- SECTION 2: JADWAL LAPANGAN (UPCOMING ATAU RECENT) -->
        @if(!empty($upcomingBookings) && count($upcomingBookings) > 0)
        <section>
            <div class="flex justify-between items-end mb-stack-md border-b border-outline-variant/20 pb-4">
                <h2 class="font-headline-md text-headline-md text-primary text-[24px]">Jadwal Terdekat Anda</h2>
                <a href="{{ route('renter.bookings.index') }}" class="text-on-tertiary-fixed-variant font-label-md text-label-md hover:underline flex items-center">Semua Jadwal <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @foreach($upcomingBookings as $booking)
                <div class="bg-surface-container-low border border-outline-variant/30 rounded-2xl p-6 flex items-center justify-between hover:bg-surface-container-lowest hover:shadow-md transition-all group cursor-pointer">
                    <div class="flex items-center gap-5">
                        <div class="w-16 h-16 rounded-2xl bg-primary-fixed flex flex-col items-center justify-center text-on-primary-fixed shadow-sm border border-primary-fixed-dim/30">
                            <span class="material-symbols-outlined text-[28px]">sports_tennis</span>
                        </div>
                        <div>
                            <h4 class="font-headline-md text-primary text-[18px] mb-1">{{ $booking->venue_name }}</h4>
                            <div class="flex items-center gap-4 text-on-surface-variant font-body-md text-sm">
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_today</span> {{ $booking->date }}</span>
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> {{ $booking->time }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('renter.bookings.show', $booking->id) }}" class="w-10 h-10 rounded-full border border-outline-variant/50 flex items-center justify-center text-on-surface-variant group-hover:bg-primary group-hover:border-primary group-hover:text-on-primary transition-colors shrink-0">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @elseif(!empty($recentBookings) && count($recentBookings) > 0)
        <section>
            <div class="flex justify-between items-end mb-stack-md border-b border-outline-variant/20 pb-4">
                <h2 class="font-headline-md text-headline-md text-primary text-[24px]">Aktivitas Terakhir</h2>
                <a href="{{ route('renter.bookings.index') }}" class="text-on-tertiary-fixed-variant font-label-md text-label-md hover:underline flex items-center">Semua Riwayat <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @foreach($recentBookings as $booking)
                <div class="bg-surface-container-low border border-outline-variant/30 rounded-2xl p-6 flex items-center justify-between hover:bg-surface-container-lowest hover:shadow-md transition-all group cursor-pointer opacity-80 hover:opacity-100">
                    <div class="flex items-center gap-5">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container-highest flex flex-col items-center justify-center text-on-surface-variant shadow-sm border border-outline-variant/30">
                            <span class="material-symbols-outlined text-[28px]">history</span>
                        </div>
                        <div>
                            <h4 class="font-headline-md text-primary text-[18px] mb-1">{{ $booking->venue_name }}</h4>
                            <div class="flex items-center gap-4 text-on-surface-variant font-body-md text-sm">
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_today</span> {{ $booking->date }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('renter.bookings.show', $booking->id) }}" class="w-10 h-10 rounded-full border border-outline-variant/50 flex items-center justify-center text-on-surface-variant group-hover:bg-surface-variant group-hover:text-on-surface-variant transition-colors shrink-0">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- SECTION 3: KATALOG SINGKAT (FEATURED COURTS) -->
        <section>
            <div class="flex justify-between items-end mb-stack-md border-b border-outline-variant/20 pb-4">
                <h2 class="font-headline-md text-headline-md text-primary text-[24px]">Rekomendasi Lapangan</h2>
                <a href="{{ route('renter.venues.index') }}" class="text-on-tertiary-fixed-variant font-label-md text-label-md hover:underline flex items-center">Eksplor Lebih Lanjut <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @foreach($featuredVenues as $venue)
                <x-venue-card :venue="$venue" />
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection
