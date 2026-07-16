@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-md relative z-10">
    
    <!-- Header -->
    <x-bookings.invoice-header :booking="$booking" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
        
        <!-- Left Column: Order Details & Upload -->
        <div class="lg:col-span-2 flex flex-col gap-stack-md">
            
            <!-- Status Banner -->
            <x-bookings.status-banner :booking="$booking" />

            <!-- Venue Details Card -->
            <x-bookings.venue-overview :booking="$booking" />

            @if($booking->status == 'Pending')
                <!-- Payment Method Card -->
                <x-bookings.payment-instructions />

                <!-- Upload Proof Card -->
                <x-bookings.payment-upload-form :booking="$booking" />
            @elseif(in_array($booking->status, ['Confirmed', 'Completed', 'confirmed', 'completed']))
                <x-ui.card padding="p-6" class="flex flex-col items-center justify-center text-center bg-primary/5 border-primary/20">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                        <x-ui.icon name="confirmation_number" class="text-[32px]" />
                    </div>
                    <h3 class="font-headline-md text-primary mb-2">Pembayaran Berhasil Dikonfirmasi</h3>
                    <p class="font-body-md text-on-surface-variant mb-6 max-w-md">
                        Pesanan Anda telah dikonfirmasi. Silakan tunjukkan E-Ticket (bukti pembayaran) kepada petugas saat Anda datang ke lokasi lapangan.
                    </p>
                    <a href="{{ route('renter.bookings.invoice', $booking->booking_code) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-primary text-on-primary font-label-lg hover:bg-primary/90 transition-colors shadow-sm">
                        <x-ui.icon name="receipt_long" class="mr-2" />
                        Lihat E-Ticket
                    </a>
                </x-ui.card>
            @endif
        </div>

        <!-- Right Column: Sticky Summary -->
        <x-bookings.payment-summary :booking="$booking" />

    </div>
</div>

<!-- Cancel Confirmation Modal -->
<x-bookings.cancel-modal :booking="$booking" />

@endsection
