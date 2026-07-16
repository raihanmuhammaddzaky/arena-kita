@props(['booking'])

<div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-outline-variant/20 flex items-center gap-2">
        <span class="material-symbols-outlined text-on-surface-variant">store</span>
        <h3 class="font-headline-md text-primary text-[18px]">Informasi Lapangan</h3>
    </div>
    <div class="p-6 flex flex-col sm:flex-row gap-6">
        <div class="w-full sm:w-32 h-32 rounded-xl overflow-hidden shrink-0 border border-outline-variant/20 shadow-sm">
            <img src="{{ $booking->venue_image }}" alt="{{ $booking->venue_name }}" class="w-full h-full object-cover">
        </div>
        <div class="flex-grow flex flex-col justify-center">
            <h4 class="font-headline-md text-primary text-[20px] mb-1">{{ $booking->venue_name }}</h4>
            <p class="font-body-md text-on-surface-variant flex items-center gap-1 mb-4">
                <span class="material-symbols-outlined text-[16px]">location_on</span> {{ $booking->venue_address }}
            </p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="font-label-md text-on-surface-variant text-[12px] mb-1">Tanggal</p>
                    <p class="font-body-md text-on-surface font-semibold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-on-tertiary-fixed-variant">calendar_today</span> {{ $booking->date }}
                    </p>
                </div>
                <div>
                    <p class="font-label-md text-on-surface-variant text-[12px] mb-1">Waktu</p>
                    <p class="font-body-md text-on-surface font-semibold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-on-tertiary-fixed-variant">schedule</span> {{ $booking->time }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
