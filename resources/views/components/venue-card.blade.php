<x-ui.card padding="p-0" class="relative group hover:-translate-y-1 transition-all duration-300 hover:shadow-md cursor-pointer flex flex-col">
    <a href="{{ route('renter.venues.show', $venue->slug) }}" class="absolute inset-0 z-10"><span class="sr-only">Lihat Detail {{ $venue->name }}</span></a>
    <!-- Image Section -->
    <div class="relative h-48 overflow-hidden bg-surface-container">
        @php
            $imageUrl = null;
            if (isset($venue->mainImage) && $venue->mainImage) {
                $imageUrl = $venue->mainImage->image_path;
            } elseif (isset($venue->image) && $venue->image) {
                $imageUrl = $venue->image;
            }
        @endphp
        @if($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $venue->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center text-on-surface-variant/30">
                <x-ui.icon name="image" class="text-[48px]" />
            </div>
        @endif
    </div>
    
    <!-- Content Section -->
    <div class="p-5 flex flex-col flex-grow">
        <div class="flex justify-between items-start mb-2">
            <h3 class="font-headline-md text-primary text-[18px] line-clamp-1 group-hover:text-tertiary-fixed-dim transition-colors">{{ $venue->name }}</h3>
        </div>
        
        <p class="font-body-md text-on-surface-variant text-[13px] flex items-center gap-1 mb-4 line-clamp-1">
            <x-ui.icon name="location_on" class="text-[16px]" /> {{ $venue->address }}
        </p>
        
        <div class="mt-auto pt-4 border-t border-outline-variant/20 flex items-center justify-between">
            <div>
                <p class="font-label-md text-on-surface-variant text-[11px] mb-0.5">Harga Sewa</p>
                <p class="font-headline-md text-primary">Rp {{ number_format($venue->price ?? 150000, 0, ',', '.') }}<span class="text-on-surface-variant font-body-md text-[12px] font-normal">/jam</span></p>
            </div>
        </div>
    </div>
</x-ui.card>