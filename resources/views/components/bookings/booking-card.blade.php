<x-ui.card padding="p-0" class="group hover:-translate-y-1 transition-all duration-300 hover:shadow-md cursor-pointer flex flex-col sm:flex-row h-full">
    <!-- Date/Status Side -->
    <div class="w-full sm:w-32 bg-surface-container-low p-4 sm:p-5 flex flex-row sm:flex-col items-center justify-between sm:justify-center border-b sm:border-b-0 sm:border-r border-outline-variant/30 shrink-0">
        <div class="text-left sm:text-center">
            <p class="font-label-md text-on-surface-variant text-[11px] uppercase tracking-wider mb-1">Tanggal</p>
            <p class="font-headline-md text-primary text-[18px] sm:text-[24px] leading-none mb-1">{{ \Carbon\Carbon::parse($booking->date)->format('d') }}</p>
            <p class="font-body-md text-on-surface-variant text-[12px] uppercase">{{ \Carbon\Carbon::parse($booking->date)->translatedFormat('M Y') }}</p>
        </div>
        
        <!-- Status Badge -->
        <div class="sm:mt-4">
            @if($booking->status == 'Pending')
                <x-ui.badge variant="warning">Pending</x-ui.badge>
            @elseif($booking->status == 'Confirmed')
                <x-ui.badge variant="success">Confirmed</x-ui.badge>
            @elseif($booking->status == 'Waiting Verification')
                <x-ui.badge variant="secondary">Menunggu</x-ui.badge>
            @else
                <x-ui.badge variant="danger">Cancelled</x-ui.badge>
            @endif
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="p-5 flex-grow flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center text-on-surface-variant shadow-sm border border-outline-variant/30 hidden sm:flex">
                    <x-ui.icon name="sports_soccer" class="text-[28px]" />
                </div>
                <div>
                    <p class="font-label-md text-on-surface-variant text-[11px] mb-0.5">ID: <span class="font-mono text-on-surface">{{ $booking->booking_code }}</span></p>
                    <h3 class="font-headline-md text-primary text-[18px] group-hover:text-tertiary-fixed-dim transition-colors">{{ $booking->venue_name }}</h3>
                </div>
            </div>
            <div class="text-right">
                <p class="font-label-md text-on-surface-variant text-[11px] mb-0.5">Total Harga</p>
                <p class="font-headline-md text-primary">Rp {{ number_format($booking->total_price ?? 150000, 0, ',', '.') }}</p>
            </div>
        </div>
        
        <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-outline-variant/20">
            <div class="flex items-center gap-4">
                <p class="font-body-md text-on-surface-variant text-[13px] flex items-center gap-1.5">
                    <x-ui.icon name="schedule" class="text-[16px]" />
                    <span class="font-medium text-on-surface">{{ $booking->time }}</span>
                </p>
                <div class="w-1 h-1 rounded-full bg-outline-variant/50 hidden sm:block"></div>
                <p class="font-body-md text-on-surface-variant text-[13px] flex items-center gap-1.5 hidden sm:flex">
                    <x-ui.icon name="timer" class="text-[16px]" />
                    <span>{{ $booking->duration ?? 1 }} Jam</span>
                </p>
            </div>
            
            <a href="{{ route('renter.bookings.show', $booking->booking_code) }}" class="inline-flex items-center gap-1.5 bg-primary/10 text-primary font-label-md px-4 py-2 rounded-lg hover:bg-primary hover:text-on-primary transition-colors text-[13px]">
                Lihat Detail <x-ui.icon name="arrow_forward" class="text-[16px]" />
            </a>
        </div>
    </div>
</x-ui.card>