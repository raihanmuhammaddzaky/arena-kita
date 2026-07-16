@props(['booking'])

<div class="lg:sticky lg:top-[100px]">
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-md overflow-hidden">
        <div class="bg-primary px-6 py-4 flex items-center gap-2 text-on-primary">
            <span class="material-symbols-outlined">receipt_long</span>
            <h3 class="font-headline-md text-[18px]">Rincian Pembayaran</h3>
        </div>
        
        <div class="p-6 flex flex-col gap-4">
            <div class="flex justify-between items-start pb-4 border-b border-outline-variant/20">
                <div>
                    <p class="font-body-md text-on-surface">{{ $booking->venue_name }}</p>
                    <p class="font-body-md text-on-surface-variant text-sm">{{ $booking->duration }} Jam x Rp {{ number_format($booking->price_per_hour, 0, ',', '.') }}</p>
                </div>
                <p class="font-body-md text-on-surface font-semibold">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</p>
            </div>

            <div class="flex justify-between items-center text-on-surface-variant">
                <p class="font-body-md">Biaya Layanan</p>
                <p class="font-body-md">Rp {{ number_format($booking->admin_fee, 0, ',', '.') }}</p>
            </div>

            <div class="flex justify-between items-center text-on-surface-variant pb-4 border-b border-outline-variant/20">
                <p class="font-body-md">Pajak (11%)</p>
                <p class="font-body-md">Rp {{ number_format($booking->tax, 0, ',', '.') }}</p>
            </div>

            <div class="flex justify-between items-center pt-2">
                <p class="font-label-md text-on-surface">Total Pembayaran</p>
                <p class="font-headline-md text-primary text-[24px]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
            </div>
        </div>
        @if($booking->status == 'Pending')
        <div class="bg-surface-container-low px-6 py-4 border-t border-outline-variant/20 text-center">
            <p class="font-body-md text-on-surface-variant text-[12px]">Pastikan nominal transfer sesuai hingga 3 digit terakhir.</p>
        </div>
        @endif
    </div>
</div>
