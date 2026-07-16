@props(['venue'])

<div class="lg:sticky lg:top-[100px]">
    <x-ui.card padding="p-6" class="shadow-md">
        <div class="flex justify-between items-end mb-6 pb-6 border-b border-outline-variant/20">
            <div>
                <p class="font-label-md text-on-surface-variant mb-1">Mulai dari</p>
                <h2 class="font-headline-lg text-primary">Rp {{ number_format($venue->price ?? 150000, 0, ',', '.') }}<span class="text-on-surface-variant text-[16px] font-normal">/jam</span></h2>
            </div>
            <div class="flex items-center gap-1">
                <x-ui.icon name="star" class="text-tertiary-fixed-dim" filled="true" />
                <span class="font-label-md text-primary">4.8</span>
            </div>
        </div>

        <form id="booking-form" action="{{ route('renter.venues.book', $venue->slug) }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div>
                <label class="font-label-md text-on-surface mb-2 block">Pilih Tanggal</label>
                <div class="flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                    <x-ui.icon name="calendar_today" class="text-on-surface-variant mr-3" />
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
                <input type="hidden" name="start_time" id="start_time">
                <input type="hidden" name="end_time" id="end_time">
                <p id="selection-error" class="text-error font-body-md text-[12px] mt-2 hidden">Pilih minimal 1 slot waktu.</p>
                @error('start_time')
                    <p class="text-error font-body-md text-[12px] mt-1">{{ $message }}</p>
                @enderror
                @if(session('error'))
                    <div class="bg-error/10 text-error p-3 rounded-lg font-body-md text-[14px] mt-2 flex items-start gap-2">
                        <x-ui.icon name="error" class="text-[18px]" />
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
    </x-ui.card>
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

        // Form Submission Validation
        const form = document.getElementById('booking-form');
        const customAlert = document.getElementById('custom-alert');
        
        form.addEventListener('submit', function(e) {
            if (!startInput.value || !endInput.value) {
                e.preventDefault();
                
                // Show Custom Alert
                customAlert.classList.remove('hidden');
                
                // Hide after 3 seconds
                setTimeout(() => {
                    customAlert.classList.add('hidden');
                }, 3000);

                selectionError.textContent = "Silakan pilih kotak jam di atas.";
                selectionError.classList.remove('hidden');
            }
        });
    });
</script>
@endpush
