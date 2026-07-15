@props(['venue'])

<a href="{{ isset($venue->disabled) && $venue->disabled ? '#' : route('renter.venues.show', $venue->slug) }}" class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden hover:shadow-md transition-all group {{ isset($venue->disabled) && $venue->disabled ? 'opacity-70 cursor-not-allowed grayscale-[30%]' : 'cursor-pointer' }} flex flex-col h-full">
    <div class="h-56 relative overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ isset($venue->image) ? $venue->image : ($venue->mainImage ? asset($venue->mainImage->image_path) : 'https://placehold.co/600x400?text=No+Image') }}" alt="{{ $venue->name }}">
        
        <div class="absolute top-4 left-4 {{ $venue->status_color ?? 'bg-secondary-container text-on-secondary-container' }} font-label-md text-[12px] px-3 py-1.5 rounded-full flex items-center shadow-sm">
            {{ $venue->status ?? 'Tersedia' }}
        </div>
    </div>
    <div class="p-6 flex flex-col flex-grow relative">
        <div class="flex justify-between items-start mb-2">
            <h3 class="font-headline-md text-primary text-[20px] line-clamp-1">{{ $venue->name }}</h3>
            @if(isset($venue->type))
            <span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-2 py-1 rounded-md text-[12px] whitespace-nowrap">{{ $venue->type }}</span>
            @endif
        </div>
        <p class="font-body-md text-body-md text-on-surface-variant mb-4 flex items-center gap-1 text-sm">
            <span class="material-symbols-outlined text-[16px]">location_on</span> <span class="line-clamp-1">{{ $venue->address }}</span>
        </p>
        <div class="mt-auto flex justify-between items-center pt-4 border-t border-outline-variant/20">
            <div>
                <span class="font-headline-md text-primary text-[18px]">Rp {{ number_format($venue->price ?? 150000, 0, ',', '.') }}</span>
                <span class="font-body-md text-on-surface-variant text-[14px]">/jam</span>
            </div>
            @if(!(isset($venue->disabled) && $venue->disabled))
                <span class="text-on-tertiary-fixed-variant font-label-md group-hover:underline flex items-center">
                    Detail <span class="material-symbols-outlined text-[18px] ml-1 transition-transform group-hover:translate-x-1">arrow_forward</span>
                </span>
            @endif
        </div>
    </div>
</a>
