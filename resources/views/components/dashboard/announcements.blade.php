@props(['announcements' => []])

@if(!empty($announcements))
<section>
    <div class="bg-surface-container-low border border-outline-variant/30 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <span class="material-symbols-outlined text-on-tertiary-fixed-variant" style="font-variation-settings: 'FILL' 1;">campaign</span>
            <h2 class="font-headline-md text-primary text-[20px]">Papan Pengumuman</h2>
        </div>
        <div class="flex flex-col gap-3">
            @foreach($announcements as $announcement)
            <div class="bg-surface-container-lowest p-4 rounded-xl border border-outline-variant/20 flex gap-4 items-start">
                <div class="w-2 h-2 mt-2 rounded-full bg-on-tertiary-fixed-variant shrink-0"></div>
                <div>
                    <p class="font-body-md text-on-surface font-bold mb-1">{{ $announcement->title }}</p>
                    <p class="font-body-md text-on-surface-variant">{{ $announcement->content }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
