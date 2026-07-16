@props(['venue'])

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
