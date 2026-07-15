@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg kawung-pattern relative z-10">
    <!-- Header -->
    <header class="mb-stack-lg">
        <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Riwayat Pemesanan</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Lacak status pesanan lapangan Anda dan unggah bukti pembayaran di sini.</p>
    </header>

    <!-- Filter Bar -->
    <form action="{{ route('renter.bookings.index') }}" method="GET" class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm border border-outline-variant/30 mb-stack-lg flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-grow w-full md:w-auto flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all">
                <span class="material-symbols-outlined text-on-surface-variant mr-3">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pesanan atau nama venue..." class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none font-body-md text-on-surface placeholder:text-on-surface-variant/70">
            </div>
            
            <div class="flex w-full md:w-auto gap-4">
                <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                    <input type="text" name="date" id="dateFilter" value="{{ request('date') }}" placeholder="Pilih Tanggal..." class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none font-body-md text-on-surface cursor-pointer pr-8" readonly>
                    <span class="material-symbols-outlined text-on-surface-variant pointer-events-none absolute right-4">calendar_today</span>
                </div>
                
                <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                    <select name="status" class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none font-body-md text-on-surface appearance-none pr-8 cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <span class="material-symbols-outlined text-on-surface-variant pointer-events-none absolute right-4">expand_more</span>
                </div>
            </div>
        </div>

        <!-- Tombol Cari & Reset -->
        <div class="flex gap-3 justify-end">
            @if(request('search') || request('date') || request('status'))
                <a href="{{ route('renter.bookings.index') }}" class="inline-flex items-center gap-2 border border-outline-variant/50 text-on-surface-variant font-label-md px-5 py-2.5 rounded-xl hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                    Reset
                </a>
            @endif
            <button type="submit" class="inline-flex items-center gap-2 bg-primary text-on-primary font-label-md px-6 py-2.5 rounded-xl hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">search</span>
                Cari
            </button>
        </div>
    </form>

    <!-- Booking List -->
    <div class="flex flex-col gap-4">
        @foreach($bookings as $booking)
        <!-- Booking Card -->
        <a href="{{ route('renter.bookings.show', $booking->id) }}" class="block bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden hover:shadow-md transition-shadow group flex flex-col md:flex-row {{ $booking->status == 'Dibatalkan' ? 'opacity-75' : '' }}">
            
            <div class="p-6 md:p-8 flex flex-col md:flex-row flex-grow items-start md:items-center justify-between gap-6">
                <!-- Left Section: Icon & Info -->
                <div class="flex items-start gap-4 w-full md:w-auto">
                    <div class="w-14 h-14 rounded-full bg-surface-container-low flex items-center justify-center shrink-0 border border-outline-variant/20 shadow-sm mt-1">
                        <span class="material-symbols-outlined text-on-surface-variant text-[28px]">sports_soccer</span>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-3 mb-1">
                            <span class="{{ $booking->status_color }} font-label-md text-[12px] px-3 py-1 rounded-full whitespace-nowrap">{{ $booking->status }}</span>
                        </div>
                        <h3 class="font-headline-md text-primary text-[20px] mb-2">{{ $booking->venue_name }}</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-on-surface-variant font-body-md text-sm">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_today</span> {{ $booking->date }}</span>
                            <span class="hidden sm:inline text-outline-variant">•</span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> {{ $booking->time }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Price & Action -->
                <div class="flex flex-row md:flex-col items-center md:items-end justify-between w-full md:w-auto pt-4 md:pt-0 border-t border-outline-variant/20 md:border-t-0 mt-2 md:mt-0 gap-4">
                    <div class="text-left md:text-right">
                        <p class="font-label-md text-on-surface-variant mb-1 text-[12px]">Total Pembayaran</p>
                        <p class="font-headline-md text-primary text-[18px]">Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
                    </div>
                    
                    <span class="font-label-md text-on-tertiary-fixed-variant group-hover:underline flex items-center whitespace-nowrap border border-on-tertiary-fixed-variant md:border-transparent px-4 py-2 md:p-0 rounded-lg md:rounded-none">
                        Lihat Detail <span class="material-symbols-outlined text-[18px] ml-1 hidden md:inline group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
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
