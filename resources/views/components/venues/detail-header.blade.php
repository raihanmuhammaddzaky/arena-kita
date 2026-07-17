@props(['venue'])

<div class="mb-stack-lg">
    <div class="rounded-2xl overflow-hidden h-[300px] md:h-[450px] relative group">
        @php
            $mainImage = isset($venue->images) ? ($venue->images->where('is_main', true)->first() ?? $venue->images->first()) : null;
            $mainImagePath = $mainImage ? $mainImage->image_url : ($venue->image ?? 'https://placehold.co/1200x600?text=No+Image');
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
</div>
