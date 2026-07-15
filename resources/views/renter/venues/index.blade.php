@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg relative z-10">
    <!-- Hero / Title Section -->
    <header class="mb-stack-lg text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Pesan Lapangan</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Temukan dan pesan lapangan olahraga terbaik untuk pertandingan Anda berikutnya.</p>
        </div>
    </header>

    <!-- Search & Filter Bar -->
    <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm border border-outline-variant/30 mb-stack-lg sticky top-[88px] z-40 backdrop-blur-md bg-surface-container-lowest/90">
        <form action="{{ route('renter.venues.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                <span class="material-symbols-outlined text-on-surface-variant mr-3">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama venue atau lokasi..." class="w-full bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent font-body-md text-on-surface placeholder:text-on-surface-variant/70">
            </div>
            <button type="submit" class="bg-primary text-on-primary font-label-md px-8 py-3 rounded-xl hover:bg-primary/90 transition-colors shadow-sm whitespace-nowrap">
                Cari Lapangan
            </button>
        </form>
    </div>

    <!-- Venue Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @forelse($venues as $index => $venue)
            <!-- Venue Card -->
            <x-venue-card :venue="$venue" />
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 py-16 flex flex-col items-center justify-center text-center">
                <div class="w-24 h-24 mb-6 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-[48px]">search_off</span>
                </div>
                <h3 class="font-headline-md text-primary mb-2">Lapangan Tidak Ditemukan</h3>
                <p class="font-body-md text-on-surface-variant max-w-md mx-auto mb-6">Maaf, kami tidak menemukan lapangan yang sesuai dengan kata kunci "{{ request('search') }}". Silakan coba dengan kata kunci lain.</p>
                <a href="{{ route('renter.venues.index') }}" class="bg-primary/10 text-primary hover:bg-primary/20 font-label-md px-6 py-2 rounded-xl transition-colors">
                    Hapus Pencarian
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $venues->links() }}
    </div>
@endsection
