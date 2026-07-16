@props(['user', 'unpaidBooking' => null])

<header class="mb-stack-lg">
    <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Welcome back, {{ $user->name }}</h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant">Ready for your next match? Here's an overview of your activities.</p>
</header>

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
