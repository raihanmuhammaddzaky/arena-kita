<x-ui.card padding="p-4" class="mb-stack-lg">
    <form action="{{ route('renter.bookings.index') }}" method="GET" class="flex flex-col gap-4">
    <div class="flex flex-col md:flex-row gap-4 items-center">
        <div class="flex-grow w-full md:w-auto flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all">
            <x-ui.icon name="search" class="text-on-surface-variant mr-3" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pesanan atau nama venue..." class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none font-body-md text-on-surface placeholder:text-on-surface-variant/70">
        </div>
        
        <div class="flex w-full md:w-auto gap-4">
            <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                <input type="text" name="date" id="dateFilter" value="{{ request('date') }}" placeholder="Pilih Tanggal..." class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none font-body-md text-on-surface cursor-pointer pr-8" readonly>
                <x-ui.icon name="calendar_today" class="text-on-surface-variant pointer-events-none absolute right-4" />
            </div>
            
            <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary transition-all relative">
                <select name="status" class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none font-body-md text-on-surface appearance-none pr-8 cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <x-ui.icon name="expand_more" class="text-on-surface-variant pointer-events-none absolute right-4" />
            </div>
        </div>
    </div>

    <!-- Tombol Cari & Reset -->
    <div class="flex gap-3 justify-end">
        @if(request('search') || request('date') || request('status'))
            <x-ui.button variant="outline" href="{{ route('renter.bookings.index') }}" icon="restart_alt">
                Reset
            </x-ui.button>
        @endif
        <x-ui.button type="submit" variant="primary" icon="search">
            Cari
        </x-ui.button>
    </div>
    </form>
</x-ui.card>
