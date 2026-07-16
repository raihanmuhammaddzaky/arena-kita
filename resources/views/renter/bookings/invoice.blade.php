@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-3xl mx-auto px-margin-mobile md:px-margin-desktop py-stack-md relative z-10 print:px-0 print:py-0 print:max-w-full">
    
    <!-- Action Bar (Hidden when printing) -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 print:hidden">
        <a href="{{ route('renter.bookings.show', $bookingData->booking_code) }}" class="inline-flex items-center text-on-surface-variant hover:text-primary transition-colors">
            <x-ui.icon name="arrow_back" class="mr-2" />
            Kembali ke Detail
        </a>
        <x-ui.button variant="primary" icon="print" onclick="window.print()">Cetak Tiket</x-ui.button>
    </div>

    <!-- Ticket Container -->
    <div class="bg-surface text-on-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 print:shadow-none print:border-none print:rounded-none relative">
        
        <!-- Ticket Header -->
        <div class="bg-primary px-8 py-6 flex flex-col sm:flex-row justify-between items-start sm:items-center text-on-primary">
            <div>
                <h1 class="font-display text-[28px] mb-1">E-Ticket</h1>
                <p class="font-body-md opacity-80">Arena Kita - Booking System</p>
            </div>
            <div class="mt-4 sm:mt-0 text-left sm:text-right">
                <p class="font-label-md opacity-80 mb-1">Status</p>
                <div class="inline-flex items-center bg-white/20 px-3 py-1 rounded-full border border-white/30 backdrop-blur-sm">
                    <x-ui.icon name="check_circle" class="text-[16px] mr-1.5" />
                    <span class="font-bold">{{ $bookingData->status }}</span>
                </div>
            </div>
        </div>

        <!-- Perforated Line Effect -->
        <div class="relative h-4 bg-surface flex items-center justify-center overflow-hidden">
            <div class="absolute w-full h-[2px] border-t-2 border-dashed border-outline-variant/30"></div>
            <div class="absolute left-[-8px] top-1/2 -translate-y-1/2 w-4 h-4 bg-surface-container-lowest rounded-full border border-outline-variant/20 z-10 print:hidden"></div>
            <div class="absolute right-[-8px] top-1/2 -translate-y-1/2 w-4 h-4 bg-surface-container-lowest rounded-full border border-outline-variant/20 z-10 print:hidden"></div>
        </div>

        <!-- Ticket Body -->
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Renter Info -->
                <div>
                    <p class="font-label-md text-on-surface-variant mb-1">Nama Penyewa</p>
                    <p class="font-headline-sm text-primary">{{ $bookingData->renter_name }}</p>
                </div>
                <!-- Booking Info -->
                <div>
                    <p class="font-label-md text-on-surface-variant mb-1">ID Pesanan</p>
                    <p class="font-mono font-bold text-lg text-on-surface">{{ $bookingData->booking_code }}</p>
                </div>
            </div>

            <!-- Venue Info Box -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/30 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <x-ui.icon name="sports_soccer" class="text-primary text-[24px]" />
                    </div>
                    <div>
                        <h3 class="font-headline-md text-primary mb-1">{{ $bookingData->venue_name }}</h3>
                        <p class="font-body-md text-on-surface-variant flex items-center gap-1">
                            <x-ui.icon name="location_on" class="text-[16px]" />
                            {{ $bookingData->venue_address }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Schedule & Details -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div>
                    <p class="font-label-md text-on-surface-variant mb-1">Tanggal Main</p>
                    <p class="font-bold text-on-surface">{{ $bookingData->date }}</p>
                </div>
                <div>
                    <p class="font-label-md text-on-surface-variant mb-1">Waktu</p>
                    <p class="font-bold text-on-surface">{{ $bookingData->time }}</p>
                </div>
                <div>
                    <p class="font-label-md text-on-surface-variant mb-1">Durasi</p>
                    <p class="font-bold text-on-surface">{{ $bookingData->duration }} Jam</p>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="border-t border-outline-variant/30 pt-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <p class="font-headline-md text-on-surface-variant mb-2 sm:mb-0">Total Pembayaran</p>
                    <div class="text-left sm:text-right">
                        <p class="font-display text-[24px] text-primary">Rp {{ number_format($bookingData->total_price, 0, ',', '.') }}</p>
                        <p class="text-[12px] text-on-surface-variant mt-1">
                            Dibayar lunas
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Footer / Barcode -->
        <div class="bg-surface-container-low px-8 py-6 flex flex-col items-center justify-center border-t border-outline-variant/20">
            <p class="font-label-md text-on-surface-variant mb-1 text-center">Tunjukkan e-ticket ini kepada petugas lapangan</p>
            <p class="font-mono font-bold text-center text-lg mt-2 tracking-widest text-primary">{{ $bookingData->booking_code }}</p>
        </div>
    </div>
</div>
@endsection
