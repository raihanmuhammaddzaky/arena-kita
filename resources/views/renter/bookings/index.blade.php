@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg kawung-pattern relative z-10">
    <!-- Header -->
    <x-page-header title="Riwayat Pemesanan" description="Lacak status pesanan lapangan Anda dan unggah bukti pembayaran di sini." />

    <!-- Filter Bar -->
    <x-bookings.filter-bar />

    <!-- Booking List -->
    <div class="flex flex-col gap-4">
        @forelse($bookings as $booking)
        <!-- Booking Card -->
        <x-bookings.booking-card :booking="$booking" />
        @empty
        <!-- Empty State -->
        <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-12 flex flex-col items-center justify-center text-center shadow-sm">
            <div class="w-20 h-20 rounded-full bg-surface-container-low flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-on-surface-variant text-[40px]">search_off</span>
            </div>
            <h3 class="font-headline-md text-primary text-[20px] mb-2">Riwayat Tidak Ditemukan</h3>
            <p class="font-body-md text-on-surface-variant max-w-md mx-auto mb-6">Kami tidak dapat menemukan pesanan yang sesuai dengan filter pencarian Anda. Silakan coba kata kunci atau filter lain.</p>
            @if(request('search') || request('date') || request('status'))
            <a href="{{ route('renter.bookings.index') }}" class="bg-primary text-on-primary font-label-md px-6 py-3 rounded-xl hover:bg-primary/90 transition-colors shadow-sm inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">restart_alt</span> Bersihkan Filter
            </a>
            @endif
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dateFilter", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
            placeholder: "Semua Tanggal",
            allowInput: true
        });
    });
</script>
@endpush

@endsection
