<x-ui.card padding="p-4" class="mb-stack-lg sticky top-[88px] z-40 backdrop-blur-md bg-surface-container-lowest/90">
    <form action="{{ route('renter.venues.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-grow flex items-center border border-outline-variant/50 rounded-xl px-4 py-3 bg-surface focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
            <x-ui.icon name="search" class="text-on-surface-variant mr-3" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama venue atau lokasi..." class="w-full bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-transparent font-body-md text-on-surface placeholder:text-on-surface-variant/70">
        </div>
        <x-ui.button type="submit" variant="primary" class="px-8 whitespace-nowrap w-full md:w-auto">
            Cari Lapangan
        </x-ui.button>
    </form>
</x-ui.card>
