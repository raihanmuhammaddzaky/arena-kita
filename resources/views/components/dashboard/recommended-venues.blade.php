@props(['featuredVenues' => []])

<section>
    <div class="flex justify-between items-end mb-stack-md border-b border-outline-variant/20 pb-4">
        <h2 class="font-headline-md text-headline-md text-primary text-[24px]">Rekomendasi Lapangan</h2>
        <a href="{{ route('renter.venues.index') }}" class="text-on-tertiary-fixed-variant font-label-md text-label-md hover:underline flex items-center">Eksplor Lebih Lanjut <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span></a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        @foreach($featuredVenues as $venue)
        <x-venue-card :venue="$venue" />
        @endforeach
    </div>
</section>
