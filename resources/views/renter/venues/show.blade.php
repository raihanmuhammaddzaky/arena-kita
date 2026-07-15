@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-md relative z-10">
    
    <!-- Back Link -->
    <a href="{{ route('renter.venues.index') }}" class="inline-flex items-center text-on-surface-variant hover:text-primary font-label-md transition-colors mb-stack-sm">
        <span class="material-symbols-outlined mr-2">arrow_back</span>
        Kembali ke Pencarian
    </a>

    <!-- Gallery Slider -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-stack-lg">
        <div class="md:col-span-3 rounded-2xl overflow-hidden h-[300px] md:h-[450px] relative group">
            <img id="main-image" src="{{ $venue->image ?? 'https://placehold.co/1200x600?text=Venue+Main+Image' }}" alt="{{ $venue->name }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
            <!-- Navigation Arrows -->
            <button class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-surface-container-lowest/80 backdrop-blur-sm flex items-center justify-center text-on-surface hover:bg-surface-container-lowest transition-colors shadow-sm opacity-0 group-hover:opacity-100">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-surface-container-lowest/80 backdrop-blur-sm flex items-center justify-center text-on-surface hover:bg-surface-container-lowest transition-colors shadow-sm opacity-0 group-hover:opacity-100">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
        <div class="flex flex-row md:flex-col gap-4 overflow-x-auto md:overflow-visible pb-2 md:pb-0 hide-scrollbar">
            <!-- Thumbnail 1 -->
            <div class="w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer border-2 border-primary">
                <img src="{{ $venue->image ?? 'https://placehold.co/300x300?text=Thumb+1' }}" alt="Thumbnail" class="w-full h-full object-cover">
            </div>
            <!-- Thumbnail 2 -->
            <div class="w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer border-2 border-transparent hover:border-primary/50 transition-colors">
                <img src="https://placehold.co/300x300?text=Thumb+2" alt="Thumbnail" class="w-full h-full object-cover">
            </div>
            <!-- Thumbnail 3 -->
            <div class="w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer border-2 border-transparent hover:border-primary/50 transition-colors">
                <img src="https://placehold.co/300x300?text=Thumb+3" alt="Thumbnail" class="w-full h-full object-cover">
            </div>
            <!-- Thumbnail 4 (More) -->
            <div class="w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer relative">
                <img src="https://placehold.co/300x300?text=Thumb+4" alt="Thumbnail" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-primary/70 flex items-center justify-center">
                    <span class="font-headline-md text-on-primary">+5</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
        <!-- Main Info -->
        <div class="lg:col-span-2 flex flex-col gap-stack-md">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <span class="bg-secondary-container text-on-secondary-container font-label-md text-[12px] px-3 py-1 rounded-full">Tersedia</span>
                    <span class="bg-surface-container-low border border-outline-variant/30 text-on-surface font-label-md text-[12px] px-3 py-1 rounded-full flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">sports_soccer</span> Futsal
                    </span>
                </div>
                <h1 class="font-display text-display text-primary mb-2">{{ $venue->name }}</h1>
                <p class="font-body-lg text-on-surface-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                    {{ $venue->address }}
                </p>
            </div>

            <div class="border-t border-outline-variant/20 pt-stack-md">
                <h3 class="font-headline-md text-primary mb-4">Fasilitas Lapangan</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-on-tertiary-fixed-variant">ac_unit</span>
                        <span class="font-body-md">AC / Ventilasi</span>
                    </div>
                    <div class="flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-on-tertiary-fixed-variant">lightbulb</span>
                        <span class="font-body-md">Premium Lighting</span>
                    </div>
                    <div class="flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-on-tertiary-fixed-variant">wc</span>
                        <span class="font-body-md">Toilet Bersih</span>
                    </div>
                    <div class="flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-on-tertiary-fixed-variant">local_parking</span>
                        <span class="font-body-md">Parkir Luas</span>
                    </div>
                    <div class="flex items-center gap-2 text-on-surface">
                        <span class="material-symbols-outlined text-on-tertiary-fixed-variant">mosque</span>
                        <span class="font-body-md">Mushola</span>
                    </div>
                </div>
            </div>

            <div class="border-t border-outline-variant/20 pt-stack-md">
                <h3 class="font-headline-md text-primary mb-4">Deskripsi Lapangan</h3>
                <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/20 shadow-sm font-body-md text-on-surface-variant leading-relaxed">
                    {{ $venue->description ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>

            <div class="border-t border-outline-variant/20 pt-stack-md">
                <h3 class="font-headline-md text-primary mb-4">Lokasi</h3>
                <div class="rounded-2xl overflow-hidden h-64 border border-outline-variant/20 relative bg-surface-container-low flex items-center justify-center">
                    <div class="text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">map</span>
                        <p class="font-label-md">Google Maps Placeholder</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Booking Card -->
        <div class="lg:sticky lg:top-[100px]">
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 shadow-md p-6">
                <div class="flex justify-between items-end mb-6 pb-6 border-b border-outline-variant/20">
                    <div>
                        <p class="font-label-md text-on-surface-variant mb-1">Mulai dari</p>
                        <h2 class="font-headline-lg text-primary">Rp {{ number_format($venue->price ?? 150000, 0, ',', '.') }}<span class="text-on-surface-variant text-[16px] font-normal">/jam</span></h2>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-tertiary-fixed-dim" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="font-label-md text-primary">4.8</span>
                    </div>
                </div>

                <form action="#" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="font-label-md text-on-surface mb-2 block">Pilih Tanggal</label>
                        <div class="flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                            <span class="material-symbols-outlined text-on-surface-variant mr-3">calendar_today</span>
                            <input type="date" class="bg-transparent border-none focus:ring-0 font-body-md text-on-surface w-full" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-label-md text-on-surface mb-2 block">Jam Mulai</label>
                            <div class="flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all">
                                <span class="material-symbols-outlined text-on-surface-variant mr-2">schedule</span>
                                <input type="time" class="bg-transparent border-none focus:ring-0 font-body-md text-on-surface w-full" value="18:00">
                            </div>
                        </div>
                        <div>
                            <label class="font-label-md text-on-surface mb-2 block">Jam Selesai</label>
                            <div class="flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all">
                                <input type="time" class="bg-transparent border-none focus:ring-0 font-body-md text-on-surface w-full" value="20:00">
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-container-low rounded-xl p-4 mt-2">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-body-md text-on-surface-variant">Durasi</span>
                            <span class="font-label-md text-on-surface">2 Jam</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-outline-variant/20">
                            <span class="font-label-md text-on-surface">Total Harga</span>
                            <span class="font-headline-md text-primary">Rp {{ number_format(($venue->price ?? 150000) * 2, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Dummy link to redirect to payment for now -->
                    <a href="{{ route('renter.bookings.show', 1) }}" class="bg-on-tertiary-fixed-variant text-on-primary font-label-md text-center py-4 rounded-xl mt-4 hover:bg-primary transition-colors shadow-sm w-full block">
                        Booking & Kunci Jadwal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
