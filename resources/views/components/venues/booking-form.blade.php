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

        <form id="booking-form" action="{{ route('renter.venues.book', $venue->slug) }}" method="POST" class="flex flex-col gap-4" data-venue-price="{{ $venue->price ?? 150000 }}" data-venue-id="{{ $venue->id ?? 1 }}">
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
<script src="{{ asset('js/booking.js') }}"></script>
@endpush

