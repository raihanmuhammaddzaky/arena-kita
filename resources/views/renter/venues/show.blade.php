@extends('layouts.app')

@section('content')
<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-md relative z-10">
    
    <!-- Breadcrumb Navigation -->
    <nav class="flex text-on-surface-variant mb-stack-md font-label-md overflow-x-auto hide-scrollbar pb-2 md:pb-0" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 whitespace-nowrap">
            <li class="inline-flex items-center">
                <a href="{{ route('renter.dashboard') }}" class="inline-flex items-center hover:text-primary transition-colors py-1 px-2 -ml-2 rounded-lg hover:bg-surface-container-low">
                    <span class="material-symbols-outlined text-[18px] mr-1.5">home</span>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-[16px] mx-1 opacity-40">chevron_right</span>
                    <a href="{{ route('renter.venues.index') }}" class="hover:text-primary transition-colors py-1 px-2 rounded-lg hover:bg-surface-container-low">Katalog Lapangan</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-[16px] mx-1 opacity-40">chevron_right</span>
                    <span class="text-primary font-bold py-1 px-2 bg-primary/5 rounded-lg border border-primary/10">{{ $venue->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Gallery Slider -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-stack-lg">
        <div class="md:col-span-3 rounded-2xl overflow-hidden h-[300px] md:h-[450px] relative group">
            @php
                $mainImage = $venue->images->where('is_main', true)->first() ?? $venue->images->first();
                $mainImagePath = $mainImage ? $mainImage->image_path : 'https://placehold.co/1200x600?text=No+Image';
            @endphp
            <img id="main-image" src="{{ $mainImagePath }}" alt="{{ $venue->name }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
            <!-- Navigation Arrows -->
            <button class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-surface-container-lowest/80 backdrop-blur-sm flex items-center justify-center text-on-surface hover:bg-surface-container-lowest transition-colors shadow-sm opacity-0 group-hover:opacity-100">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-surface-container-lowest/80 backdrop-blur-sm flex items-center justify-center text-on-surface hover:bg-surface-container-lowest transition-colors shadow-sm opacity-0 group-hover:opacity-100">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
        <div class="flex flex-row md:flex-col gap-4 overflow-x-auto md:overflow-visible pb-2 md:pb-0 hide-scrollbar" id="thumbnail-container">
            @forelse($venue->images->take(4) as $index => $image)
                @if($index == 3 && $venue->images->count() > 4)
                    <!-- Thumbnail 4 (More) -->
                    <div class="w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer relative">
                        <img src="{{ $image->image_path }}" alt="Thumbnail" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-primary/70 flex items-center justify-center">
                            <span class="font-headline-md text-on-primary">+{{ $venue->images->count() - 3 }}</span>
                        </div>
                    </div>
                @else
                    <!-- Thumbnail {{ $index + 1 }} -->
                    <div onclick="document.getElementById('main-image').src='{{ $image->image_path }}'; Array.from(this.parentElement.children).forEach(c => { c.classList.remove('border-primary'); c.classList.add('border-transparent'); }); this.classList.remove('border-transparent'); this.classList.add('border-primary');" class="thumbnail-item w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer border-2 {{ $image->is_main ? 'border-primary' : 'border-transparent hover:border-primary/50' }} transition-colors">
                        <img src="{{ $image->image_path }}" alt="Thumbnail" class="w-full h-full object-cover">
                    </div>
                @endif
            @empty
                <div class="w-24 md:w-full h-24 md:h-[101px] shrink-0 rounded-xl overflow-hidden cursor-pointer border-2 border-primary">
                    <img src="https://placehold.co/300x300?text=Thumb+1" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
            @endforelse
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
                <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/20 shadow-sm flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-secondary-container/50 text-on-secondary-container flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-label-md text-primary mb-1">Alamat Lengkap</h4>
                        <p class="font-body-md text-on-surface-variant leading-relaxed">
                            {{ $venue->address ?? 'Alamat belum tersedia.' }}
                        </p>
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

                <form action="{{ route('renter.venues.book', $venue->id) }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="font-label-md text-on-surface mb-2 block">Pilih Tanggal</label>
                        <div class="flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                            <span class="material-symbols-outlined text-on-surface-variant mr-3">calendar_today</span>
                            <input type="date" name="date" class="bg-transparent border-none focus:ring-0 font-body-md text-on-surface w-full" value="{{ date('Y-m-d') }}">
                        </div>
                        @error('date')
                            <p class="text-error font-body-md text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-label-md text-on-surface mb-2 flex items-center justify-between">
                            <span>Pilih Jam <span class="text-error">*</span></span>
                            <span id="loading-spinner" class="hidden w-4 h-4 border-2 border-primary border-t-transparent rounded-full animate-spin"></span>
                        </label>
                        <div id="time-slot-grid" class="grid grid-cols-4 sm:grid-cols-5 gap-2 max-h-[250px] overflow-y-auto pr-2 custom-scrollbar">
                            <!-- Slots will be rendered here by JS -->
                            <p class="col-span-full text-center text-on-surface-variant font-body-md text-sm py-4">Silakan pilih tanggal terlebih dahulu.</p>
                        </div>
                        <input type="hidden" name="start_time" id="start_time" required>
                        <input type="hidden" name="end_time" id="end_time" required>
                        <p id="selection-error" class="text-error font-body-md text-[12px] mt-2 hidden">Pilih minimal 1 slot waktu.</p>
                        @error('start_time')
                            <p class="text-error font-body-md text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                        @if(session('error'))
                            <div class="bg-error/10 text-error p-3 rounded-lg font-body-md text-[14px] mt-2 flex items-start gap-2">
                                <span class="material-symbols-outlined text-[18px]">error</span>
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <div class="bg-surface-container-low rounded-xl p-4 mt-2">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-body-md text-on-surface-variant">Durasi</span>
                            <span class="font-label-md text-on-surface" id="display-duration">0 Jam</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-outline-variant/20">
                            <span class="font-label-md text-on-surface">Total Harga</span>
                            <span class="font-headline-md text-primary" id="display-price">Rp 0</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-on-tertiary-fixed-variant text-on-primary font-label-md text-center py-4 rounded-xl mt-4 hover:bg-primary transition-colors shadow-sm w-full block">
                        Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.querySelector('input[type="date"]');
        const gridContainer = document.getElementById('time-slot-grid');
        const spinner = document.getElementById('loading-spinner');
        const displayDuration = document.getElementById('display-duration');
        const displayPrice = document.getElementById('display-price');
        const startInput = document.getElementById('start_time');
        const endInput = document.getElementById('end_time');
        const selectionError = document.getElementById('selection-error');
        const venuePrice = {{ $venue->price ?? 150000 }};
        const venueId = {{ $venue->id ?? 1 }};
        
        let selectedSlots = [];

        // Generate time slots (08:00 to 22:00)
        const generateAllSlots = () => {
            let slots = [];
            for (let i = 8; i <= 21; i++) {
                const start = i.toString().padStart(2, '0') + ':00';
                const end = (i + 1).toString().padStart(2, '0') + ':00';
                slots.push({ start, end });
            }
            return slots;
        };

        const updateSelectionUI = () => {
            // Sort selected slots
            selectedSlots.sort();
            
            // Check if selection is contiguous
            let isValid = true;
            if (selectedSlots.length > 1) {
                for(let i=1; i<selectedSlots.length; i++) {
                    const prevEnd = parseInt(selectedSlots[i-1].split('-')[1].split(':')[0]);
                    const currStart = parseInt(selectedSlots[i].split('-')[0].split(':')[0]);
                    if(prevEnd !== currStart) {
                        isValid = false;
                        break;
                    }
                }
            }

            if(!isValid) {
                selectionError.textContent = "Mohon pilih jam yang berurutan (tidak boleh melompat).";
                selectionError.classList.remove('hidden');
                displayDuration.textContent = '0 Jam';
                displayPrice.textContent = 'Rp 0';
                startInput.value = '';
                endInput.value = '';
                return;
            } else {
                selectionError.classList.add('hidden');
            }

            // Update duration & price
            const duration = selectedSlots.length;
            displayDuration.textContent = duration + ' Jam';
            displayPrice.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(duration * venuePrice);

            // Update hidden inputs
            if(duration > 0) {
                startInput.value = selectedSlots[0].split('-')[0];
                endInput.value = selectedSlots[selectedSlots.length - 1].split('-')[1];
            } else {
                startInput.value = '';
                endInput.value = '';
            }

            // Update button styles
            const buttons = gridContainer.querySelectorAll('button:not(:disabled)');
            buttons.forEach(btn => {
                const slotValue = btn.dataset.slot;
                if(selectedSlots.includes(slotValue)) {
                    btn.classList.remove('bg-surface-container-low', 'text-on-surface');
                    btn.classList.add('bg-primary', 'text-on-primary', 'border-primary');
                } else {
                    btn.classList.add('bg-surface-container-low', 'text-on-surface');
                    btn.classList.remove('bg-primary', 'text-on-primary', 'border-primary');
                }
            });
        };

        const handleSlotClick = (e) => {
            const btn = e.currentTarget;
            const slotValue = btn.dataset.slot;
            
            if(selectedSlots.includes(slotValue)) {
                // Deselect
                selectedSlots = selectedSlots.filter(s => s !== slotValue);
            } else {
                // Select
                selectedSlots.push(slotValue);
            }
            updateSelectionUI();
        };

        const fetchAvailability = async (date) => {
            if(!date) return;
            
            spinner.classList.remove('hidden');
            gridContainer.innerHTML = '';
            selectedSlots = [];
            updateSelectionUI();

            try {
                // Fetch availability
                const response = await fetch(`/venues/${venueId}/availability?date=${date}`);
                const data = await response.json();
                const bookedSlots = data.booked_slots; // Array of {start_time, end_time}
                
                const allSlots = generateAllSlots();
                
                allSlots.forEach(slot => {
                    // Check if this slot is booked
                    // A slot is booked if its start time falls within any booked period
                    const isBooked = bookedSlots.some(booked => {
                        const bStart = booked.start_time.substring(0, 5);
                        const bEnd = booked.end_time.substring(0, 5);
                        return slot.start >= bStart && slot.start < bEnd;
                    });

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.dataset.slot = `${slot.start}-${slot.end}`;
                    btn.className = `font-label-md text-[12px] py-2 rounded-xl border transition-colors ${
                        isBooked 
                        ? 'bg-surface-container-highest border-outline-variant/30 text-on-surface-variant opacity-50 cursor-not-allowed' 
                        : 'bg-surface-container-low border-outline-variant/50 text-on-surface hover:border-primary/50'
                    }`;
                    btn.textContent = slot.start;
                    
                    if(isBooked) {
                        btn.disabled = true;
                        btn.title = 'Sudah dipesan';
                    } else {
                        btn.addEventListener('click', handleSlotClick);
                    }
                    
                    gridContainer.appendChild(btn);
                });

            } catch (error) {
                console.error("Failed to fetch availability", error);
                gridContainer.innerHTML = '<p class="col-span-full text-center text-error text-sm">Gagal memuat jadwal.</p>';
            } finally {
                spinner.classList.add('hidden');
            }
        };

        // Listen for date change
        dateInput.addEventListener('change', (e) => fetchAvailability(e.target.value));
        
        // Initial load
        if(dateInput.value) fetchAvailability(dateInput.value);
    });
</script>
@endpush
@endsection
