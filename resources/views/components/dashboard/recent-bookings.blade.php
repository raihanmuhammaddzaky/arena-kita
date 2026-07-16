@props(['upcomingBookings' => [], 'recentBookings' => []])

@if(!empty($upcomingBookings) && count($upcomingBookings) > 0)
<section>
    <div class="flex justify-between items-end mb-stack-md border-b border-outline-variant/20 pb-4">
        <h2 class="font-headline-md text-headline-md text-primary text-[24px]">Jadwal Terdekat Anda</h2>
        <a href="{{ route('renter.bookings.index') }}" class="text-on-tertiary-fixed-variant font-label-md text-label-md hover:underline flex items-center">Semua Jadwal <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach($upcomingBookings as $booking)
        <div class="bg-surface-container-low border border-outline-variant/30 rounded-2xl p-6 flex items-center justify-between hover:bg-surface-container-lowest hover:shadow-md transition-all group cursor-pointer relative">
            <a href="{{ route('renter.bookings.show', $booking->booking_code) }}" class="absolute inset-0 z-10"><span class="sr-only">Detail Pesanan</span></a>
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
        <div class="bg-surface-container-low border border-outline-variant/30 rounded-2xl p-6 flex items-center justify-between hover:bg-surface-container-lowest hover:shadow-md transition-all group cursor-pointer opacity-80 hover:opacity-100 relative">
            <a href="{{ route('renter.bookings.show', $booking->booking_code) }}" class="absolute inset-0 z-10"><span class="sr-only">Detail Aktivitas</span></a>
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
        </div>
        @endforeach
    </div>
</section>
@endif
