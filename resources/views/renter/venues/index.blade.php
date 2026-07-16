@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg relative z-10">
    <!-- Hero / Title Section -->
    <x-page-header title="Pesan Lapangan" description="Temukan dan pesan lapangan olahraga terbaik untuk pertandingan Anda berikutnya." />

    <!-- Search & Filter Bar -->
    <x-venues.search-bar />

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
