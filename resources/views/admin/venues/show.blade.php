@extends('layouts.admin')

@section('title', 'ArenaKita Admin - Detail Lapangan')

@section('content')
    <div class="max-w-container-max mx-auto w-full flex flex-col gap-stack-lg pb-24 md:pb-margin-desktop" x-data="{ tab: 'informasi' }">
        <!-- Breadcrumbs & Header Actions -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2 text-sm text-on-surface-variant font-label-md">
                    <a href="{{ route('admin.venues.index') }}" class="hover:text-primary transition-colors">Venues</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-on-surface">Detail Lapangan</span>
                </div>
                <div class="flex items-center gap-4">
                    <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary">{{ $venue->name }}</h2>
                    <x-admin.badge 
                        :color="$venue->is_active ? 'success' : 'error'" 
                        :text="$venue->is_active ? 'Aktif' : 'Nonaktif'" 
                    />
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.venues.edit', $venue) }}" class="px-4 py-2 bg-secondary-container text-on-secondary-container rounded-lg font-label-md text-label-md hover:shadow-md transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">edit</span>Edit
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tab Navigation -->
        <div class="border-b border-outline-variant">
            <nav class="-mb-px flex gap-8" aria-label="Tabs">
                <button @click="tab = 'informasi'" :class="tab === 'informasi' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-on-surface hover:border-outline-variant'" class="whitespace-nowrap py-4 px-1 border-b-2 font-label-md text-label-md transition-colors">
                    Informasi Umum
                </button>
                <button @click="tab = 'riwayat'" :class="tab === 'riwayat' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-on-surface hover:border-outline-variant'" class="whitespace-nowrap py-4 px-1 border-b-2 font-label-md text-label-md transition-colors">
                    Riwayat Penyewaan
                </button>
            </nav>
        </div>

        <!-- Tab Content 1: Informasi Umum -->
        <div x-show="tab === 'informasi'" class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Left Column: Details -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <!-- Card: Informasi Dasar -->
                <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-4">
                    <h3 class="font-headline-md text-[20px] leading-[28px] text-primary">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="font-label-md text-label-md text-on-surface-variant">Nama Lapangan</span>
                            <span class="text-on-surface font-medium">{{ $venue->name }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-md text-label-md text-on-surface-variant">Slug</span>
                            <span class="text-on-surface font-mono text-sm">{{ $venue->slug }}</span>
                        </div>
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-1">
                            <span class="font-label-md text-label-md text-on-surface-variant">Alamat</span>
                            <span class="text-on-surface">{{ $venue->address }}</span>
                        </div>
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-1">
                            <span class="font-label-md text-label-md text-on-surface-variant">Deskripsi</span>
                            <span class="text-on-surface">{{ $venue->description ?? 'Belum ada deskripsi.' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Card: Harga & Kapasitas -->
                <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-4">
                    <h3 class="font-headline-md text-[20px] leading-[28px] text-primary">Harga & Kapasitas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="font-label-md text-label-md text-on-surface-variant">Harga per Jam</span>
                            <span class="text-on-surface font-medium text-lg">Rp {{ number_format($venue->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-md text-label-md text-on-surface-variant">Kapasitas Maksimal</span>
                            <span class="text-on-surface font-medium">{{ $venue->max_capacity }} Orang</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Media -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <div class="bg-surface-container-lowest rounded-xl shadow-md p-6 flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-headline-md text-[20px] leading-[28px] text-primary">Media Lapangan</h3>
                        <span class="font-label-md text-label-md text-on-surface-variant">{{ $venue->images->count() }}/4 Foto</span>
                    </div>
                    
                    <!-- Main Photo Preview -->
                    <div class="aspect-[4/3] rounded-lg overflow-hidden relative bg-surface-container">
                        @if($venue->mainImage)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $venue->mainImage->image_path) }}" alt="{{ $venue->name }}">
                            <span class="absolute top-2 left-2 px-2 py-1 bg-surface/80 backdrop-blur-sm text-primary font-label-md text-[12px] rounded-md">Utama</span>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-5xl">image</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Gallery Grid -->
                    @php $galleryImages = $venue->images->where('is_main', false); @endphp
                    @if($galleryImages->count() > 0)
                        <div class="grid grid-cols-3 gap-2 mt-2">
                            @foreach($galleryImages as $img)
                                <div class="aspect-square rounded-md overflow-hidden">
                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $img->image_path) }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tab Content 2: Riwayat Penyewaan -->
        <div x-show="tab === 'riwayat'" style="display: none;" class="flex-col gap-6">
            <div class="bg-surface-container-lowest rounded-xl shadow-md overflow-hidden">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md border-b border-outline-variant">
                                <th class="p-4 font-semibold">Kode Booking</th>
                                <th class="p-4 font-semibold">Nama Penyewa</th>
                                <th class="p-4 font-semibold">Tanggal</th>
                                <th class="p-4 font-semibold">Jam</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-right">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="font-body-md text-on-surface">
                            @forelse($bookings as $booking)
                                <tr class="border-b border-outline-variant hover:bg-surface-container-lowest/50 transition-colors">
                                    <td class="p-4 font-medium font-mono text-sm">{{ $booking->booking_code }}</td>
                                    <td class="p-4">{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $booking->booking_date->format('d M Y') }}</td>
                                    <td class="p-4">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                    <td class="p-4">
                                        @php
                                            $statusColor = match($booking->status) {
                                                'confirmed' => 'success',
                                                'pending', 'waiting' => 'warning',
                                                'cancelled' => 'error',
                                                default => 'primary',
                                            };
                                        @endphp
                                        <x-admin.badge :color="$statusColor" :text="ucfirst($booking->status)" />
                                    </td>
                                    <td class="p-4 text-right {{ $booking->status === 'cancelled' ? 'text-on-surface-variant line-through' : '' }}">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-on-surface-variant">Belum ada riwayat penyewaan untuk lapangan ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div class="p-4 border-t border-outline-variant bg-surface-container-low">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
