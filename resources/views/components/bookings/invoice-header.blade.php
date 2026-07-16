@props(['booking'])

<!-- Back Link -->
<a href="{{ route('renter.bookings.index') }}" class="inline-flex items-center text-on-surface-variant hover:text-primary font-label-md transition-colors mb-stack-sm">
    <span class="material-symbols-outlined mr-2">arrow_back</span>
    Kembali ke Riwayat
</a>

<!-- Header -->
<header class="mb-stack-lg flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Detail Pesanan</h1>
        <p class="font-body-lg text-on-surface-variant flex items-center gap-2">
            ID Pesanan: <span class="font-bold font-mono">{{ $booking->booking_code }}</span>
            <button class="text-on-tertiary-fixed-variant hover:text-primary transition-colors" title="Salin ID">
                <span class="material-symbols-outlined text-[18px]">content_copy</span>
            </button>
        </p>
    </div>
</header>
