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
        <form class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                <span class="material-symbols-outlined text-on-surface-variant mr-3">search</span>
                <input type="text" placeholder="Cari nama venue atau lokasi..." class="w-full bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent font-body-md text-on-surface placeholder:text-on-surface-variant/70">
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                    <span class="material-symbols-outlined text-on-surface-variant mr-3">calendar_today</span>
                    <input type="text" id="booking_date" class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent font-body-md text-on-surface w-full sm:w-auto cursor-pointer p-0" placeholder="Pilih Tanggal">
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center border border-outline-variant/50 rounded-xl px-3 sm:px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                        <span class="material-symbols-outlined text-on-surface-variant mr-2">schedule</span>
                        <input type="text" id="start_time" class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent font-body-md text-on-surface w-14 sm:w-16 text-center cursor-pointer p-0" placeholder="Mulai">
                    </div>
                    <span class="text-on-surface-variant">-</span>
                    <div class="flex items-center border border-outline-variant/50 rounded-xl px-3 sm:px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                        <input type="text" id="end_time" class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent font-body-md text-on-surface w-14 sm:w-16 text-center cursor-pointer p-0" placeholder="Selesai">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="bg-primary text-on-primary font-label-md px-8 py-3 rounded-xl hover:bg-primary/90 transition-colors shadow-sm whitespace-nowrap">
                Cari Lapangan
            </button>
        </form>
    </div>

    <!-- Venue Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @foreach($venues as $index => $venue)
            <!-- Venue Card -->
            <a href="{{ isset($venue->disabled) && $venue->disabled ? '#' : route('renter.venues.show', $venue->id) }}" class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden hover:shadow-md transition-all group {{ isset($venue->disabled) && $venue->disabled ? 'opacity-70 cursor-not-allowed grayscale-[30%]' : 'cursor-pointer' }} flex flex-col">
                <div class="relative overflow-hidden h-56">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ isset($venue->image) ? $venue->image : ($venue->mainImage ? asset($venue->mainImage->image_path) : 'https://placehold.co/600x400?text=No+Image') }}" alt="{{ $venue->name }}">
                    
                    <div class="absolute top-4 left-4 {{ $venue->status_color ?? 'bg-secondary-container text-on-secondary-container' }} font-label-md text-[12px] px-3 py-1.5 rounded-full flex items-center shadow-sm">
                        {{ $venue->status ?? 'Tersedia' }}
                    </div>

                    <div class="absolute top-4 right-4 bg-surface-container-lowest/90 backdrop-blur-sm px-3 py-1.5 rounded-full flex items-center gap-1 shadow-sm">
                        <span class="material-symbols-outlined text-tertiary-fixed-dim text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="font-label-md text-primary">{{ $venue->rating ?? '4.5' }}</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow relative">
                    <div class="flex items-center gap-1 text-on-surface-variant mb-2">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        <span class="font-label-md text-sm">{{ $venue->address }}</span>
                    </div>
                    <h3 class="font-headline-md text-primary text-[22px] mb-2">{{ $venue->name }}</h3>
                    <div class="mt-auto pt-4 border-t border-outline-variant/20 flex justify-between items-center">
                        <div>
                            <span class="font-headline-md text-primary text-[18px]">Rp {{ number_format($venue->price ?? 150000, 0, ',', '.') }}</span>
                            <span class="font-body-md text-on-surface-variant text-[14px]">/jam</span>
                        </div>
                        @if(!(isset($venue->disabled) && $venue->disabled))
                            <span class="text-on-tertiary-fixed-variant font-label-md group-hover:underline flex items-center">
                                Detail <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span>
                            </span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Load More -->
    <div class="mt-12 text-center">
        <button class="border border-outline-variant text-on-surface font-label-md px-8 py-3 rounded-xl hover:bg-surface-container-low transition-colors">
            Muat Lebih Banyak
        </button>
    </div>
</div>

@push('scripts')
<!-- Load Flatpickr library -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize Flatpickr for Date Input
        flatpickr("#booking_date", {
            dateFormat: "Y-m-d",
            defaultDate: "today",
            minDate: "today",
            disableMobile: "true", // ensures native picker is bypassed on mobile for consistent UI
            altInput: true,
            altFormat: "F j, Y"
        });

        // Initialize Flatpickr for Time Inputs
        let endTimePicker = flatpickr("#end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 60,
            defaultDate: "20:00",
            minTime: "07:00",
            maxTime: "23:00",
            disableMobile: "true"
        });

        let startTimePicker = flatpickr("#start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 60,
            defaultDate: "18:00",
            minTime: "06:00",
            maxTime: "22:00",
            disableMobile: "true",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates[0]) {
                    // Min end time is 1 hour after start time
                    let minEndTime = new Date(selectedDates[0]);
                    minEndTime.setHours(minEndTime.getHours() + 1);
                    
                    let minEndTimeStr = minEndTime.getHours().toString().padStart(2, '0') + ':00';
                    endTimePicker.set('minTime', minEndTimeStr);
                    
                    // If current end time is invalid, update it
                    let currentEnd = endTimePicker.selectedDates[0];
                    if (!currentEnd || currentEnd <= selectedDates[0]) {
                        endTimePicker.setDate(minEndTime);
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
