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
            @endif
        </div>

        <!-- Right Column: Sticky Summary -->
        <x-bookings.payment-summary :booking="$booking" />

    </div>
</div>

<!-- Cancel Confirmation Modal -->
<x-bookings.cancel-modal :booking="$booking" />

@endsection
